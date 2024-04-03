<div>
    <div class="grid grid-cols-2 gap-4">
        <x-card>
            <div class="flex justify-between">
                <div class="w-full max-w-sm">
                    <a href="#" class="text-xl text-blue-900 font-bold">Notes Sent</a>
                    <h2 class="text-2xl font-bold mt-4">{{ $notesSentCount }}</h2>
                </div>
            </div>                
        </x-card>

        <x-card>
            <div class="flex justify-between">
                <div class="w-full max-w-sm">
                    <a href="#" class="text-xl text-blue-900 font-bold">Notes Loved</a>
                    <h2 class="text-2xl font-bold mt-4">{{ $notesLovedCount }}</h2>
                </div>
            </div>                
        </x-card>
    </div>
</div>
