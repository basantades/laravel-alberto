<!-- resources/views/livewire/user-search-component.blade.php -->
<div class="flex">
    <label for="userSelect">Selecciona un usuario:</label>
    <select id="userSelect" wire:model="selectedUserId" class="form-control">
        <option value="">Selecciona un usuario...</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <!-- Botón de redirección -->
    @if ($selectedUserId)
        <button 
            class="btn btn-primary mt-3" 
            wire:click="updatedSelectedUserId"
        >
            Ir a la conversación
        </button>
    @endif
</div>
