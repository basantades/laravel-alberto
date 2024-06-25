<!-- resources/views/livewire/conversations-component.blade.php -->
<div>
    <h2 class="text-2xl mb-8 text-center">Mis Conversaciones</h2>
    @if($conversations->isEmpty())
        <p>No tienes conversaciones.</p>
    @else
        <ul >
            @foreach($conversations as $conversation)
                <li class="mb-8 w-10/12 mx-auto border-b pb-8">
                    @php
                        $otherUser = $conversation->sender_id === Auth::id() ? $conversation->receiver : $conversation->sender;
                    @endphp
                    <a href="{{ route('privatemessages.show', $otherUser->id) }}" class="flex gap-4 justify-between items-center">
                        <div class="flex gap-4 items-center">
                    <img src="{{ $otherUser->profile_photo_url }}" alt="" class="w-12 h-12 rounded-full object-cover">
                        <div>
                        <strong class="text-lg">{{ $otherUser->name }}</strong>
                        <br>
                        <small>Último mensaje: {{ $conversation->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                    <x-primary-button class="h-fit">{{ __('Ver Conversación') }}</x-primary-button>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
