<!-- resources/views/livewire/conversations-component.blade.php -->
<div>
    <h2>Mis Conversaciones</h2>
    @if($conversations->isEmpty())
        <p>No tienes conversaciones.</p>
    @else
        <ul>
            @foreach($conversations as $conversation)
                <li>
                    @php
                        $otherUser = $conversation->sender_id === Auth::id() ? $conversation->receiver : $conversation->sender;
                    @endphp
                    <a href="{{ route('privatemessages.show', $otherUser->id) }}">
                        <strong>{{ $otherUser->name }}</strong>: {{ $conversation->body }}
                        <br>
                        <small>{{ $conversation->created_at->diffForHumans() }}</small>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
