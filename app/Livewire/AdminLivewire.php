<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AdminLivewire extends Component
{
    public $users;
    public $user;
    
    public function render()
    {
        return view('livewire.admin-livewire');
    }

    public function mount()
    {
        $this->users = User::all();
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        $this->users = User::all(); //actualiza el listado
    }

    public function makeAdmin(User $user)
    {
        // dd(1);
        $this->authorize('update', $user);
        if ($user->admin == 1) {
            $user->admin = 0;
        } else {
            $user->admin = 1;
        }

        $user->save();
        $this->users = User::all(); //actualiza el listado
    }
}

