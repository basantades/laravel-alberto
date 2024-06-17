<div>
    <form wire:submit.prevent="import">
        <input type="file" wire:model="file">
        <x-primary-button type="submit" class="btn btn-primary col-span-1 w-fit">Importar</x-primary-button>
    </form>
    {{-- <x-primary-button wire:click="import({{ $user }})" class="btn btn-primary col-span-1 w-fit">Upload news</x-primary-button> --}}
    @if (@session('status'))
    <div class="bg-green-500 text-white text-center p-2 mt-3 rounded-md">{{ session('status') }}</div>
    @endif
</div>
