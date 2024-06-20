<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="pt-12">

        <div class="min-w-full sm:px-6 lg:px-8">
            <livewire:search-posts /> 
        </div>
        <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg min-w-full flex justify-center">
            <div class="p-6 text-gray-900 w-8/12">
                <h3 class="text-2xl mb-4">{{ __('Create New') }}</h3>
                <livewire:create-post /> 
            </div>
        </div>
    </div>

</x-app-layout>
