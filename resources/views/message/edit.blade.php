<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit message') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST"  action="{{ route('messages.update', $messageText) }}">
                        @csrf
                        @method('PUT')
                        <textarea name="message" id="message" class="w-full" placeholder="Enter your message">{{ old ('message', $messageText->message) }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        <x-primary-button class="mt-4">{{__('Edit')}}</x-primary-button>
                    </form>
                    @if (session('status'))
                    <div class="bg-green-500 text-white text-center p-4 mt-3 rounded-md">{{ session('status') }}</div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
