<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $notesSentCount, $notesLovedCount; 

    public function mount()
    {
        $this->notesSentCount = Auth()->user()->notes()
            ->where('send_date', '<', now())
            ->where('is_published', true)
            ->count();
            
        $this->notesLovedCount = Auth()->user()->notes()->sum('heart_count');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
