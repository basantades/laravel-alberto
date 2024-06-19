<div class="mt-8 overflow-auto">
    
    <div class="mb-4 border-b pb-4 grid grid-cols-12 gap-2">
        <h3 class="text-lg font-bold">id</h3>
        <h3 class="text-lg font-bold col-span-2">name</h3>
        <h3 class="text-lg font-bold col-span-3">email</h3>
        <h3 class="text-lg font-bold col-span-2">created_at</h3>
        <h3 class="text-lg font-bold text-center">admin</h3>
    </div>
        @foreach ($users as $user)
            
        <div class="mb-4 border-b pb-4 grid grid-cols-12 gap-2 items-center">
            <div class="flex justify-between items-center"><p>{{ $user->id }}</p><img src="{{ $user->profile_photo_url }}" alt="" class="w-10 h-10 rounded-full object-cover"></div>
            <p class="col-span-2">{{ $user->name }}</p>
            <p class="col-span-3">{{ $user->email }}</p>
            <p class="col-span-2">{{ $user->created_at->format('j M Y, H:i:s') }}</p>
            <p class="text-center">@if ($user->admin) {{ 'si' }}
                @else {{ 'no' }}
            @endif</p>
            <x-secondary-button wire:click="makeAdmin({{ $user->id }})" class="btn btn-primary col-span-2 w-fit">
                @if ($user->admin)Remove Admin
                @else Admin
                @endif
            </x-secondary-button>
            <x-primary-button wire:click="destroy({{ $user->id }})" class="btn btn-primary col-span-1 w-fit">Delete</x-primary-button>
        </div>
        @endforeach
        <div class="mt-8 w-full flex flex-col items-center">
        <x-primary-button wire:click="download({{ $user->id }})" class="btn btn-primary col-span-1 w-fit">Download XLSX</x-primary-button>


       
    </div>
    </div>

