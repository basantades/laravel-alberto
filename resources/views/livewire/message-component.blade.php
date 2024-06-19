<!-- resources/views/livewire/message-component.blade.php -->

<div>
    {{-- <div class="messages">
        @foreach($privateMessages as $message)
            <div class="@if($message->sender_id === Auth::id()) sent @else received @endif">
                <p>{{ $message->body }}</p>
            </div>
        @endforeach
    </div> --}}

    <form wire:submit.prevent="sendMessage">
        <textarea wire:model="body" placeholder="Escribe tu mensaje..."></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>
