<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if (@session('status'))
        <div class="bg-green-500 text-white text-center p-2 mt-3 rounded-md">{{ session('status') }}</div>
        @endif
            <div class="bg-white mt-8 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 border-b pb-4 grid grid-cols-12 gap-2">
                        <h3 class="text-lg font-bold">id</h3>
                        <h3 class="text-lg font-bold col-span-2">name</h3>
                        <h3 class="text-lg font-bold col-span-3">email</h3>
                        <h3 class="text-lg font-bold col-span-2">created_at</h3>
                        <h3 class="text-lg font-bold">admin</h3>
                    </div>
                        @foreach ($users as $user)

                        <div class="mb-4 border-b pb-4 grid grid-cols-12 gap-2 items-center">
                            <div class="flex justify-between items-center"><p>{{ $user->id }}</p><img src="{{ $user->profile_photo_url }}" alt="" class="w-10 h-10 rounded-full object-cover"></div>
                        <p class="col-span-2">{{ $user->name }}</p>
                        <p class="col-span-3">{{ $user->email }}</p>
                        <p class="col-span-2">{{ $user->created_at->format('j M Y, H:i:s') }}</p>
                        <p>@if ($user->admin) {{ 'si' }}
                            @else {{ 'no' }}
                        @endif</p>
                        <form class="col-span-2" method="POST" action="{{ route('users.update', $user) }}">
                            @csrf @method('PUT')
                        <x-secondary-button :href="route('users.update', $user)" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-primary col-span-1">
                            @if ($user->admin)
                                Remove Admin
                            @else
                            Admin
                                
                            @endif
                        </x-secondary-button>
                        </form>  
                        <form method="POST" action="{{ route('users.delete', $user) }}">
                            @csrf @method('DELETE')
                        <x-primary-button :href="route('users.delete', $user)" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-primary col-span-1">Delete</x-primary-button>
                        </form>    
                    </div>
                    @endforeach
                </div>
                <form method="GET" action="{{ route('users.download', $user) }}" class="mb-8 w-full flex flex-col items-center">
                    @csrf 
                <x-primary-button :href="route('users.download')" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-primary col-span-1">Download xlsx</x-primary-button>
                </form>                </div>
            </div>
        </div>
    </div>
</x-app-layout>
