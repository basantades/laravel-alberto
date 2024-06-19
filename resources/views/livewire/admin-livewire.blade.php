<div class="mt-8 overflow-auto">
    <div class="mb-4 border-b pb-4 grid grid-cols-12 gap-2">
        <h3 class="text-lg font-bold">id</h3>
        <h3 class="text-lg font-bold col-span-2">name</h3>
        <h3 class="text-lg font-bold col-span-3">email</h3>
        <h3 class="text-lg font-bold col-span-1">created_at</h3>
        <h3 class="text-lg font-bold col-span-2 text-center">admin</h3>
    </div>
        @foreach ($users as $user)

        <div class="mb-4 border-b pb-4 grid grid-cols-12 gap-2 items-center">
            <div class="flex justify-between items-center"><p>{{ $user->id }}</p><img src="{{ $user->profile_photo_url }}" alt="" class="w-10 h-10 rounded-full object-cover"></div>
        <p class="col-span-2">{{ $user->name }}</p>
        <p class="col-span-3">{{ $user->email }}</p>
        <p class="col-span-1">{{ $user->created_at->format('j M Y') }}</p>
        <div class="flex gap-2  items-center col-span-2 justify-center">
        <p>@if ($user->admin) {{ 'si' }}
            @else {{ 'no' }}
        @endif 
    </p>
        <form class="col-span-2" method="POST" action="{{ route('users.update', $user) }}">
            @csrf @method('PUT')
        <x-secondary-button :href="route('users.update', $user)" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-primary col-span-1">
            @if ($user->admin)
                Remove
            @else
            Admin
                
            @endif
        </x-secondary-button>
    </div>
        </form>  
        <form method="POST" action="{{ route('users.delete', $user) }}">
            @csrf @method('DELETE')
        <x-primary-button :href="route('users.delete', $user)" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-primary col-span-1">Delete</x-primary-button>
        </form>    
    
    <div class="col-span-2">
        <a href="{{ route('privatemessages.show', ['receiver' => $user->id]) }}" class="border bg-blue-500 text-white px-4 py-1 h-fit rounded-lg">
            Mensaje Privado
        </a>   
    </div>
    </div>
    @endforeach
        <div class="mt-8 w-full flex flex-col items-center">
        <x-primary-button wire:click="download({{ $user->id }})" class="btn btn-primary col-span-1 w-fit">Download XLSX</x-primary-button>


       
    </div>
    </div>

