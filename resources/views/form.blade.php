<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('form.store') }}" method="POST">
                        @csrf
                        <textarea name="message" id="message" placeholder="{{__('Enter your message')}}" class="w-full">{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-primary-button class=" mt-4  ">{{__('Submit message')}}</x-primary-button>
                        @if (@session('status'))
                        <div class="bg-green-500 text-white text-center p-2 mt-3 rounded-md">{{ session('status') }}</div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="bg-white mt-8 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($messages as $message)
                    <div class="mb-4 border-b pb-4 flex justify-between ">
                    <div class="flex gap-5">
                        
                        <img src="{{ $message->user->profile_photo_url }}" alt="profile_photo" class="w-20 h-20 rounded-full object-cover">
                        <div>
                        <span class="mr-6 text-xl">{{ $message->user->name }}</span>
                        <small class="text-gray-400">{{ $message->created_at->format('j M Y, H:i:s') }}</small>
                        <small class="text-gray-400">{{  $message->created_at != $message->updated_at ? '- Edited at ' . $message->updated_at->format('j M Y, H:i:s') : '' }}</small>
                        <p class="mt-2">{{ $message->message }}</p>
                        <div class="card-footer mt-2">
                            @if (! $reacterFacade->hasReactedTo($message, 'Like'))
                            <a href="{{ route('messages.like', $message) }}" class="btn btn-primary btn-sm gap-2 flex text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                              </svg> {{ $message->viaLoveReactant()->getReactionCounters()->count() }} 
                              </a>
                            @else
                                <a href="{{ route('messages.unlike', $message) }}" class="btn btn-primary btn-sm gap-2 flex text-gray-500"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#EA0E25" class="size-6">
                                    <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                  </svg>
                                   {{ $message->viaLoveReactant()->getReactionCounters() }}</a>
                            @endif
    
                            {{-- @if (! $message->disliked)
                                <a href="{{ route('messages.dislike', $message) }}" class="btn btn-secondary btn-sm">({{ $message->dislikesCount }}) No me gusta</a>
                            @else
                                <a href="{{ route('messages.undislike', $message) }}" class="btn btn-secondary btn-sm text-red-600">({{ $message->dislikesCount }}) Te disgusta</a>
                            @endif --}}
                        </div>
                    </div>
                </div>
                    {{-- @if (auth()->user()->id == $message->user_id) --}}
                    @can('update', $message)
                    <x-dropdown>
                        <x-slot name="trigger">
                        <button>
                        <svg class="h-6 w-6 text-gray-400" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"></path>
            </svg>
                        </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('messages.edit', $message)">Edit</x-dropdown-link>
                            <form method="POST" action="{{ route('messages.delete', $message) }}">
                                @csrf @method('DELETE')
                            <x-dropdown-link :href="route('messages.delete', $message)" onclick="event.preventDefault(); this.closest('form').submit();">Delete</x-dropdown-link>
                        </form>

                        </x-slot>
                    </x-dropdown>
                    @endcan
                    {{-- @endif --}}
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
