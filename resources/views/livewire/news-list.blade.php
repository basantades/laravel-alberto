<div>
    <div class="grid grid-cols-3 gap-8">
    @foreach ($lastposts as $post)
    <div class=" sm:rounded-lg items-center">
        <div class="p-6 text-gray-900 border-2 border-gray-200">
                <span class="mr-6 text-xl font-bold">{{ $post->title }}</span>
                <p class="text-sm">{{ $post->category != null ? 'Category: ' . $post->category : '' }}</p>
                <p class="mt-2">{{ $post->content }}</p>
                <small class="text-gray-400">{{ $post->created_at->format('j M Y, H:i:s') }}</small>
                {{-- <div x-data="{ expanded: false }">
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
                </div> --}}
                <div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="flex justify-center w-full mt-8">
    <a href="{{ route('posts.index') }}">    <x-primary-button class="ml-3"  >{{ __('Ver todo') }}</x-primary-button>
    </a>
</div>
</div>
