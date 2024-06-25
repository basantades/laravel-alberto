<div>
    <p class="mb-4">Importar archivo xlsx</p>
    <form wire:submit.prevent="importNews">
        <input type="file" wire:model="file" >
        <div>
        <x-primary-button type="submit" class="btn btn-primary col-span-1 w-fit mt-4">Importar</x-primary-button>
    </div>
    </form>

    <!-- Muestra mensajes de éxito o error -->
    @if (session()->has('success'))
        <div class="bg-green-500 text-white text-center p-2 mt-3 rounded-md">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-500 text-white text-center p-2 mt-3 rounded-md">{{ session('error') }}</div>
    @endif

    <!-- Mostrar errores de validación de Livewire -->
    @error('file') <span class="error text-red-500">{{ $message }}</span> @enderror
</div>
