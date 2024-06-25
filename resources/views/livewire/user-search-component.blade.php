<div class="flex justify-center mb-8 w-10/12 mx-auto items-center gap-4">
    <div class="flex flex-col">
    {{-- <label for="userSelect">Selecciona un usuario:</label> --}}
    <select id="userSelect" wire:model="selectedUserId"  class="form-control">
        <option value="">Selecciona un usuario...</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
</div>

    <!-- Botón de redirección -->
        <x-primary-button 
            wire:click="redirectToConversation"
        >
            Ir a la conversación
        </x-primary-button >
</div>
