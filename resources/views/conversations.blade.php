<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mensajes privadas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <livewire:conversations-component /> 

                    <h2 class="text-xl font-bold mt-12 mb-4 text-center">Nueva conversacion</h2>
                    <livewire:user-search-component /> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
