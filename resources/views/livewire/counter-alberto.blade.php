<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="flex items-center gap-2">
        <button wire:click="decrement" class="rounded bg-blue-500 w-10 py-1 text-white text-xl hover:bg-blue-400 active:bg-blue-200">-</button>
        <p class="text-xl text-center font-bold px-4 min-w-14">{{ $count }}</p>
        <button wire:click="increment" class="rounded bg-blue-500 w-10 py-1 text-white text-xl hover:bg-blue-400 active:bg-blue-200">+</button>
    </div>
</div>
