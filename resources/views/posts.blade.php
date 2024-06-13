<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-12 grid grid-cols-2">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center gap-8 flex-wrap">
            @foreach ($allposts as $post)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-96 aparicionFadeUp">
                <div class="p-6 text-gray-900">
                        <span class="mr-6 text-xl font-bold">{{ $post->title }}</span>
                        <p class="text-sm">{{ $post->category != null ? 'Category: ' . $post->category : '' }}</p>
                        
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
                                <small class="text-gray-400">{{ $post->created_at->format('j M Y, H:i:s') }}</small>
                            </div>
                        </div>
                        <div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="min-w-full sm:px-6 lg:px-8">
            <livewire:search-posts /> 
        </div>
    </div>
</x-app-layout>
