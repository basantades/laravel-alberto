<?php

namespace App\Http\Controllers;

use App\Models\MessageText;
use Illuminate\Http\Request;

class MessageTextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('form', [
            'messages'=>MessageText::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message'=>['required', 'min:3', 'max:255'],
        ]);
        // MessageText::create([
        //     'message'=>request('message'),
        //     'user_id'=>auth()->id(),
        //     ]);
        $request->user()->messages()->create($validated);
            session()->flash('status', 'Message sent successfully');
            return to_route('form.store');
    }

    /**
     * Display the specified resource.
     */
    public function show(MessageText $MessageText)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   
    public function edit(MessageText $MessageText)
    {
        $this->authorize('update', $MessageText); 
        
       return view('message.edit', [
           'messageText' => $MessageText,

       ]);
    }

    public function like(MessageText $MessageText)
    {
        dd($MessageText);
        $likedByArray = json_decode($MessageText->liked_by, true) ?? [];

        // Verificar si el usuario ya dio like
        if (!in_array(auth()->id(), $likedByArray)) {
            $likedByArray[] = auth()->id();
            $MessageText->liked_by = json_encode($likedByArray);
            $MessageText->save();
        }
    
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MessageText $MessageText)
    {
        $this->authorize('update', $MessageText);

        $validated=$request->validate([
            'message'=>['required', 'min:3', 'max:255'],
        ]);

        $MessageText->update($validated);

        return to_route('form.store')
        ->with('status', 'Message updated successfully');

        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MessageText $MessageText)
    {
        // if (auth()->user()->id != $MessageText->user_id){
        //     abort(403);
        //     }

        $this->authorize('delete', $MessageText);
        $MessageText->delete();
        return back()->with('status', 'Message deleted successfully');
    }
}
