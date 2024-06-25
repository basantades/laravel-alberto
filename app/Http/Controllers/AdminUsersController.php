<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Policies\UserAdminPolicy;
use Illuminate\Auth\Access\Gate;
use Rap2hpoutre\FastExcel\FastExcel;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {

        // $this->authorize('view', $user);
        
        if (auth()->user()->admin)
            return view('adminUsers', [
                'users'=>User::get(),
            ]);

        abort(403, 'Unauthorized action.');

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

    }

    /**
     * Display the specified resource.
     */
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   
    public function edit(User $User)
    {

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $User)
    {
    if ($User->admin == 0) {
        $User->admin = 1;
        $User->save();} 
        else {
            $User->admin = 0;
            $User->save();
        }
       

        return back()->with('status', 'User already has this role');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        if (auth()->user()->admin)
        $User->delete();
        return back()->with('status', 'User deleted successfully');

    }

    public function download(User $User)
    {
    if (auth()->user()->admin)
            // // Load users
            // $users = User::all();

            // // Export all users
            // (new FastExcel($users))->export('albertoUsers.xlsx');
            
            return (new FastExcel(User::all()))->download('albertoUsers.xlsx');
        }
}