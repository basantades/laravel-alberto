<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserSearchComponent extends Component
{
    public $selectedUserId = null; // ID del usuario seleccionado

    public function updatedSelectedUserId()
    {
        // Validamos que el usuario seleccionado exista en la base de datos
        $user = User::find($this->selectedUserId);
        if ($user) {
            // Redirigimos al usuario a la conversación privada con el usuario seleccionado
            return redirect()->route('privatemessages.show', ['receiver' => $user->id]);
        }
    }

    public function render()
    {
        $users = User::where('id', '!=', Auth::id())
            ->orderBy('name')
            ->get();

        return view('livewire.user-search-component', [
            'users' => $users,
        ]);
    }
}
