<!-- resources/views/messages/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mensajes Privados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h2 class="text-2xl">Conversación con {{ $receiver->name }}</h2>
                        @livewire('message-component', ['receiverId' => $receiver->id])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
