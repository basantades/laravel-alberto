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

    {{-- <button wire:click="search" class="ml-4 rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-400 active:bg-blue-200">search</button> --}}
    
</div>
    <div class="my-8">
        @if (count($posts) > 0)
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
        @endif
    </div>
</div>