<form wire:submit.prevent="submit" class="w-full max-w-lg mx-auto"> 
    <x-label class="mt-2">Note Title</x-label>
    <x-input type="text" wire:model="title" class="w-full mb-4" placeholder="It's been a great day."  />
    @error('title')
        <x-alert color="red" title="Error!" message="{{ $message }}" btn-title="Close" />
    @enderror

    <x-label class="mt-2">Your Note</x-label>
    <textarea wire:model="content" class="w-full mb-4 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 rounded-md" rows="4" placeholder="Share all your thoughts with your friend."></textarea>
    @error('content')
        <x-alert color="red" title="Error!" message="{{ $message }}" btn-title="Close" />
    @enderror

    <x-label class="mt-2">Recipient</x-label>
    <x-input type="email" wire:model="recipient" class="w-full mb-4" placeholder="yourfriend@email.com" />
    @error('recipient')
        <x-alert color="red" title="Error!" message="{{ $message }}" btn-title="Close" />
    @enderror

    <x-label class="mt-2">Send Date</x-label>
    <x-input type="date" wire:model="sendDate" class="w-full mb-4" placeholder="Send Date" />
    @error('sendDate')
        <x-alert color="red" title="Error!" message="{{ $message }}" btn-title="Close" />
    @enderror

    @isset($noteId)
        <x-input type="checkbox" wire:model="isPublished" />&nbsp;Note Published
    @endisset

    <div class="flex flex-col">
        @isset($noteId)
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-900 text-white font-bold text-center px-4 py-2 mt-6 mx-auto rounded block" wire:click.prevent="$emit('update')"><span>Save Note</span></button>
        @else
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-900 text-white font-bold text-center px-4 py-2 mt-6 mx-auto rounded block" wire:click.prevent="$emit('store')"><span>Schedule Note</span></button>
        @endisset
        <a href="{{ route('notes.index') }}" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold text-center px-4 py-2 mt-4 rounded">Cancel</a>
    </div>
</form>
