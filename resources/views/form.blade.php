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
                        <div class="card-footer mt-2 flex gap-4">
                            @if (! $reacterFacade->hasReactedTo($message, 'Like'))
                            <a href="{{ route('messages.like', $message) }}" class="btn btn-primary btn-sm gap-2 flex text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                  </svg> 
                              {{ $message->viaLoveReactant()->getReactionCounterOfType('Like')->getCount() }} 
                              </a>
                            @else
                                <a href="{{ route('messages.unlike', $message) }}" class="btn btn-primary btn-sm gap-2 flex text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FFDD05" class="size-6">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                      </svg>
                                   {{ $message->viaLoveReactant()->getReactionCounterOfType('Like')->getCount() }}</a>
                            @endif
    
                            
                            @if (! $reacterFacade->hasReactedTo($message, 'dislike'))
                            <a href="{{ route('messages.dislike', $message) }}" class="btn btn-primary btn-sm gap-2 flex text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                  </svg>
                                  
                              {{ $message->viaLoveReactant()->getReactionCounterOfType('dislike')->getCount() }} 
                              </a>
                            @else
                                <a href="{{ route('messages.undislike', $message) }}" class="btn btn-primary btn-sm gap-2 flex text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#444444" class="size-6">
                                        <path d="M15.73 5.5h1.035A7.465 7.465 0 0 1 18 9.625a7.465 7.465 0 0 1-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 0 1-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.499 4.499 0 0 0-.322 1.672v.633A.75.75 0 0 1 9 22a2.25 2.25 0 0 1-2.25-2.25c0-1.152.26-2.243.723-3.218.266-.558-.107-1.282-.725-1.282H3.622c-1.026 0-1.945-.694-2.054-1.715A12.137 12.137 0 0 1 1.5 12.25c0-2.848.992-5.464 2.649-7.521C4.537 4.247 5.136 4 5.754 4H9.77a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23ZM21.669 14.023c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.958 8.958 0 0 1-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227Z" />
                                      </svg>
                                      
                                   {{ $message->viaLoveReactant()->getReactionCounterOfType('dislike')->getCount() }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                <a href="{{ route('privatemessages.show', ['receiver' => $message->user->id]) }}" class="border bg-blue-500 text-white px-4 py-1 h-fit rounded-lg">
                    Mensaje Privado
                </a>   
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
                    </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
