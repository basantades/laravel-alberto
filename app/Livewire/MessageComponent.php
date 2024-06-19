<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PrivateMessage;
use Illuminate\Support\Facades\Auth;

class MessageComponent extends Component
{
    public $receiverId;
    public $body = '';
    public $privateMessages = []; // Cambiado el nombre de la propiedad

    protected $rules = [
        'body' => 'required|string',
    ];

    public function mount($receiverId)
    {
        $this->receiverId = $receiverId;
        $this->loadPrivateMessages(); // Actualizar para llamar a la nueva función
    }

    public function loadPrivateMessages()
    {
        $this->privateMessages = PrivateMessage::where(function($query) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $this->receiverId);
            })
            ->orWhere(function($query) {
                $query->where('sender_id', $this->receiverId)
                      ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function sendMessage()
    {
        $this->validate();

        PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $this->receiverId,
            'body' => $this->body,
        ]);

        $this->body = ''; // Limpiar el campo del mensaje
        $this->loadPrivateMessages(); // Recargar los mensajes después de enviar uno nuevo
    }

    public function render()
    {
        return view('livewire.message-component', [
            'privateMessages' => $this->privateMessages,
        ]);
    }
    
}
