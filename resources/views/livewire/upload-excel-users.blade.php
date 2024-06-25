<div class="flex flex-col items-center">
    <p class="mb-4 mt-8">Importar archivo xlsx</p>

    <form wire:submit.prevent="importUsers"  class="flex flex-col items-center">
        <input type="file" wire:model="file" >
        <div>
        <x-primary-button type="submit" class="btn btn-primary col-span-1 w-fit mt-4">Importar xlsx</x-primary-button>
    </div>
    </form>

    <!-- Muestra mensajes de éxito o error -->
    @if (session()->has('success'))
        <div class="bg-green-500 text-white text-center p-2 mt-3 rounded-md w-full">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-500 text-white text-center p-2 mt-3 rounded-md w-full">{{ session('error') }}</div>
    @endif

    <!-- Mostrar errores de validación de Livewire -->
    @error('file') <span class="error text-red-500">{{ $message }}</span> @enderror
</div>
