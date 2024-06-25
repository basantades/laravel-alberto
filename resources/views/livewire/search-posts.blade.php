<div class="bg-white shadow-sm sm:rounded-lg mb-10 p-8 min-w-full grid grid-cols-1">
    <div>
    <input type="text" placeholder="Buscar..." wire:model="searchTerm" wire:keydown='search'>
    <select wire:model="selectedCategory" wire:change="search">>
        <option value="{{ $category = null }}">Todas las categorías</option>
        @foreach ($categories as $category)
        @if ($category != null){
            <option value="{{ $category }}">{{ $category }}</option>
        }
        @endif
        @endforeach
    </select>
 <select wire:model="selectedUserId" wire:change="search">
    <option value="">Todos los usuarios</option>
    @foreach ($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
</select>

    {{-- <button wire:click="search" class="ml-4 rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-400 active:bg-blue-200">search</button> --}}
    
</div>
    <div class="my-8 mosaic">
        @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <div class="mosaic-item">
                    <img src="{{ $post->image }}" alt="">
                        <h2 class="mt-4 text-2xl font-bold">{{ $post->title }}</h2>
                        <p class="text-sm mb-4">{{ $post->category != null ? 'Category: ' . $post->category : '' }}</p>
                        
                        <div x-data="{ expanded: false }">
                            <button type="button" x-on:click="expanded = ! expanded">
                                <span class="text-sm font-bold text-blue-500 flex" x-show="! expanded"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                  </svg>Show post content 
                                  </span>
                                <span class="text-sm font-bold text-blue-500 flex" x-show="expanded"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                  </svg>Hide post content 
                                  </span>
                            </button>
                            <div x-show="expanded">
                                <p class="mt-2">{{ $post->content }}</p>
                                <div class="flex gap-4 mt-4">
                                    @if ($post->user)
                                    <img src="{{ $post->user->profile_photo_url }}" class="w-12 h-12 rounded-full" alt="Foto de {{ $post->user->name }}">
                                @endif                                
                                <div>
                                    @if ($post->user)
                                <p class="text-gray-400">{{ $post->user != null ? 'Autor: ' . $post->user->name : 'User: ' }}</p>
                                @endif  
                                <small class="text-gray-400">{{ $post->created_at->format('j M Y, H:i:s') }}</small>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        @else
            <p>No hay resultados</p>
        @endif
        {{-- @if (count($posts) > 0)
        <table>
            @foreach ($posts as $post)
                <tr class="grid mb-6 min-w-full elementos-aparicion">
                    <td class="text-xl font-bold">{{ $post->title }}</td>
                    <td class="text-sm">{{ $post->category != null ? 'Category: ' . $post->category : '' }}</td>
                    <td>{{ $post->content }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No hay resultados</p>
    @endif --}}
    </div>
</div>