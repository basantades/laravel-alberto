<!-- resources/views/livewire/message-component.blade.php -->

<div class="mt-8 flex flex-col gap-8">
    <div>
        @foreach($privateMessages as $message)
            <div class="@if($message->sender_id === Auth::id()) sent @else received @endif">
                <p class="text-sm text-gray-400">{{ $message->sender_id === Auth::id() ? 'Yo' : $message->sender->name }} - {{ $message->created_at->diffForHumans() }}</p>
                <p  class="mb-4 border-b pb-4">{{ $message->body }}</p>
            </div>
        @endforeach
    </div>

    <form wire:submit.prevent="sendMessage()" class="flex flex-col gap-3">
        <textarea wire:model="body" placeholder="Escribe tu mensaje..."></textarea>
        <x-primary-button type="submit">Enviar</x-primary-button>
    </form>
</div>
