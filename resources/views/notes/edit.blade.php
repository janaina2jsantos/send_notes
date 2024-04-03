<?php
    $url = explode("/", $_SERVER['REQUEST_URI']);
    $id = $url[2];
?>

<x-app-layout>
    <x-header route="{{ route('notes.index') }}" linkText="Notes" class="px-6 text-gray-400">
        Edit Note
    </x-header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="block bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-6 border-b border-gray-200">
                    <livewire:notes :createEditNote="true" :id="$id" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
