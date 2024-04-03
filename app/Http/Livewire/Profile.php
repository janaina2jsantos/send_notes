<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $userId, $name, $email, $password, $passwordConfirm;
    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required|string|min:5',
        'email' => 'required|email',
        'password' => 'nullable|min:8',
        'passwordConfirm' => 'same:password'
    ];

    public function mount($user=null)
    {
        if (!$user) {
            $user = Auth()->user();
        }
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function submit()
    {
        $this->validate();
        $this->dispatchBrowserEvent('scrollToTop');

        try {
            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => isset($this->password) ? Hash::make($this->password) : $user->password
            ]);
            session()->flash('message', 'User updated successfully.');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('message', 'Something went wrong while updating the user!');
        }

        $this->mount($user);
        $this->reset(['password', 'passwordConfirm']);
    }

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Are you sure?',
            'text' => 'You are about to delete this account permanently.',
            'id' => $id
        ]);
    }

    public function delete($id)
    {   
        try {
            // delete the user and their notes
            $user = User::findOrFail($id);
            if ($user->notes()->count()) {
                $user->notes()->delete();
            }
            $user->delete();
            // Log the user out
            Auth::logout();
            return redirect()->route('login')->with('message', 'Your account has been deleted successfully.');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('message', 'Something went wrong while deleting your account!');
        }
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
