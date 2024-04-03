<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="block overflow-hidden sm:rounded-lg">
                <div class="px-6 py-6 border-gray-200">
                    <livewire:dashboard />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
