<div>
    <div>
        <div>
            @if (session()->has('message'))
                <x-alert size="1/2" color="green" title="Success!" mgTop="2" mgBottom="4" message="{{ session('message') }}" btn-title="Close" />
            @endif
        </div>

        @if(!$createEditNote)
            <x-header route="{{ route('notes.create') }}" linkText="Create Note" class="w-40 bg-blue-500 hover:bg-blue-900 text-white font-bold text-center px-4 py-2 rounded" content="end"></x-header>
            @if(!$notes->count() > 0)
                <div class="flex flex-col text-center">
                    <p class="text-lg font-bold">No notes yet</p>
                    <p class="text-sm">Let's create your first note to send.</p>
                    <a href="{{ route('notes.create') }}" class="w-40 bg-blue-500 hover:bg-blue-900 text-white font-bold text-center px-4 py-2 mt-6 mx-auto rounded">Add Note</a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-4 px-12 py-12 md:grid-cols-3">
                    @foreach($notes as $note)
                        <x-card wire:key='{{ $note->id }}'>
                            <div class="flex justify-between">
                                <div class="w-full max-w-sm">
                                    <a href="#" class="text-xl text-blue-900 font-bold hover:underline" wire:click="show('{{ $note->id }}')">{{ $note->title }}</a>
                                    <p class="text-xs mt-2">{{ Str::limit($note->content, 50) }}</p>
                                </div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}</div>
                            </div>

                            <div class="flex justify-between items-end mt-4 space-x-2">
                                <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span></p>
                                <div class="flex justify-center items-center">
                                    <div class="flex justify-center items-center">
                                        <a href="{{ route('notes.edit', $note->id) }}">
                                            <div class="h-10 w-10 bg-gray-500 shadow-md text-white flex justify-center items-center mx-1 rounded-full hover:bg-blue-900 cursor-pointer">
                                                <ion-icon name="create-outline"></ion-icon>
                                            </div>
                                        </a>
                                        <div class="h-10 w-10 bg-gray-500 shadow-md text-white flex justify-center items-center mx-1 rounded-full hover:bg-blue-900 cursor-pointer" wire:click="deleteConfirm('{{ $note->id }}')">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-card>
                    @endforeach
                </div>
            @endif
        @else
            @include('includes.form')
        @endif
    </div>
</div>

