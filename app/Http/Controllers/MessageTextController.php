<?php

namespace App\Http\Controllers;

use App\Models\MessageText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageTextController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index( MessageText $MessageText)
    {
        $user = Auth::user();
        $reacterFacade = $user->viaLoveReacter();
        $reactionCounters = $MessageText->viaLoveReactant()->getReactionCounters();

        return view('form', [
            'messages'=>MessageText::with('user')->latest()->get(),
            'reacterFacade'=>$reacterFacade,
            'reactionCounters'=>$reactionCounters,
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

    public function like(MessageText $MessageText)
    {
    //     $user = Auth::user();
    //     $reacterFacade = $user->viaLoveReacter();
    //     $isReacted = $reacterFacade->hasReactedTo($MessageText, 'Like');
    //     $isNotReacted = $reacterFacade->hasNotReactedTo($MessageText, 'Like');
    //   dd($isReacted);
        $user = Auth::user();
        $reacterFacade = $user->viaLoveReacter();
        $reacterFacade->reactTo($MessageText, 'Like');

        return back();
    }
    
    public function unlike(MessageText $MessageText)
    {
        $user = Auth::user();
        $reacterFacade = $user->viaLoveReacter();
        $reacterFacade->unreactTo($MessageText, 'Like');

        return back();
    }

    public function dislike(MessageText $MessageText)
    {
        $user = Auth::user();
        $reacterFacade = $user->viaLoveReacter();
        $reacterFacade->reactTo($MessageText, 'dislike');

        return back();
    }

    public function undislike(MessageText $MessageText)
    {
        $user = Auth::user();
        $reacterFacade = $user->viaLoveReacter();
        $reacterFacade->unreactTo($MessageText, 'dislike');

        return back();
    }
}
