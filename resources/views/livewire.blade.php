<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pruebas Livewire') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl mb-4">{{ __('Counter') }}</h3>
                    <livewire:counter-alberto /> 
                </div>
            </div>
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl mb-4">{{ __('List') }}</h3>
                    <livewire:todo-list /> 
                </div>
            </div>
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl mb-4">{{ __('Create New') }}</h3>
                    <livewire:create-post /> 
                </div>
            </div>
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl mb-4">{{ __('Latest News') }}</h3>
                    <livewire:news-list /> 
                </div>
            </div>

            @can('update', auth()->user())

                <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl mb-4">{{ __('Users') }}</h3>
                    <livewire:admin-livewire /> 
                </div>
            </div>
            @endcan
        </div>
    </div>
</x-app-layout>
