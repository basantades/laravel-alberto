<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserSearchComponent extends Component
{
    public $selectedUserId = null; // ID del usuario seleccionado

    // Método del ciclo de vida: no se debe llamar manualmente
    public function updatedSelectedUserId()
    {
        // Este método se llama automáticamente cuando cambia el valor de selectedUserId
        $user = User::find($this->selectedUserId);
        if ($user) {
            // Puedes añadir lógica aquí si es necesario, pero no redirecciones
        }
    }

    // Método de acción: puede ser llamado desde el frontend
    public function redirectToConversation()
    {
        $user = User::find($this->selectedUserId);
        if ($user) {
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

