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
                        <x-primary-button class="mt-4">{{__('Submit')}}</x-primary-button>
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
