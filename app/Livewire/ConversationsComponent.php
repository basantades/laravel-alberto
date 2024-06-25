<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\User;
use App\Models\PrivateMessage;
use Illuminate\Support\Facades\Auth;

class ConversationsComponent extends Component
{
    public $conversations = [];

    public function mount()
    {
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $userId = Auth::id();

        $this->conversations = PrivateMessage::select('id', 'sender_id', 'receiver_id', 'body', 'created_at')
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->get()
            ->groupBy(function($message) use ($userId) {
                return $message->sender_id === $userId ? $message->receiver_id : $message->sender_id;
            })
            ->map(function($messages) {
                return $messages->sortByDesc('created_at')->first();
            })
            ->values();
    }

    public function render()
    {
        return view('livewire.conversations-component', [
            'conversations' => $this->conversations,
        ]);
    }
}

