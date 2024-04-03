<div>
    <x-header route="{{ route('dashboard') }}" linkText="Dashboard" class="px-6 text-gray-400">
        Profile
    </x-header>
    <form wire:submit.prevent="submit"> 
        @if (session()->has('message'))
            <x-alert size="1/2" color="green" title="Success!" top="6" bottom="[-25px]" message="{{ session('message') }}" btn-title="Close" />
        @endif

        <div class="grid grid-cols-1 gap-4 px-16 py-12">
            <x-card>
                <div class="flex justify-between">
                    <div class="w-full max-w-xl">
                        <a href="#" class="text-xl text-blue-900 font-bold">Profile Information</a>
                        <p class="text-sm text-gray-600 mt-2">Update your account's profile information and email address.</p>
                        <x-label class="mt-4">Name</x-label>
                        <x-input type="text" wire:model="name" class="w-full mb-4" />
                        @error('name')
                            <x-alert color="red" title="Error!" message="{{ $message }}" btn-title="Close" />
                        @enderror
                        <x-label class="mt-1">Email</x-label>
                        <x-input type="text" wire:model="email" class="w-full mb-4" />
                        @error('email')
                            <x-alert color="red" title="Error!" message="{{ $message }}" btn-title="Close" />
                        @enderror
                    </div>
                </div>                
            </x-card>

            <x-card>
                <div class="flex justify-between">
                    <div class="w-full max-w-xl">
                        <a href="#" class="text-xl text-blue-900 font-bold">Update Password</a>
                        <p class="text-sm text-gray-600 mt-2">Ensure your account is using a long, random password to stay secure.</p>
                        <x-label class="mt-4">New Password</x-label>
                        <x-input type="password" wire:model="password" class="w-full mb-4" />
                        @error('password')
                            <x-alert color="red" title="Error!" message="{{ $message }}" btn-title="Close" />
                        @enderror
                        <x-label class="mt-1">Confirm Password</x-label>
                        <x-input type="password" wire:model="passwordConfirm" class="w-full mb-4" />
                        @error('passwordConfirm')
                            <x-alert color="red" title="Error!" message="{{ $message }}" btn-title="Close" />
                        @enderror
                    </div>
                </div> 
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-900 text-white font-bold px-4 py-2 mt-6 rounded block"><span>Save</span></button>
                </div>              
            </x-card>

            <x-card>
                <div class="flex justify-between">
                    <div class="w-full max-w-xl">
                        <a href="#" class="text-xl text-blue-900 font-bold">Delete Account</a>
                        <p class="text-sm text-gray-600 mt-2">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                    </div>
                </div> 
                <div>
                    <a href="#" class="w-40 bg-red-600 hover:bg-red-500 text-white text-center font-bold px-4 py-2 mt-6 rounded block" wire:click="deleteConfirm('{{ $userId }}')"><span>Delete Account</span></a>
                </div>               
            </x-card>
        </div>
    </form>
</div>
