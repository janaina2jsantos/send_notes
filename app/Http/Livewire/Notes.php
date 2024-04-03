<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Notes extends Component
{
    use AuthorizesRequests;

    public $notes, $noteId, $title, $content, $recipient, $sendDate, $isPublished, $heartCount;
    public $createEditNote = false;
    protected $listeners = ['store', 'update', 'delete', 'increaseHeartCount'];

    protected $rules = [
        'title' => 'required|string|min:5',
        'content' => 'required|string|min:20',
        'recipient' => 'required|email',
        'sendDate' => 'required|date'
    ];

    public function mount($id=false)
    {
        if ($id) {
            $note = Note::findOrFail($id);
            $this->authorize('update', $note);
            $this->noteId = $id;
            $this->title = $note->title;
            $this->content = $note->content;
            $this->recipient = $note->recipient;
            $this->sendDate = $note->send_date->format('Y-m-d');
            $this->isPublished = $note->is_published;
        }
        
        $this->notes = Auth()->user()->notes()->orderBy('id', 'DESC')->get();
    }

    public function store()
    {
        $this->validate();
        $this->dispatchBrowserEvent('scrollToTop');

        try {
            Note::create([
                'user_id' => Auth::user()->id,
                'title' => $this->title,
                'content' => $this->content,
                'recipient' => $this->recipient,
                'send_date' => $this->sendDate
            ]);
            session()->flash('message', 'Note created successfully.');
        }
        catch(\Exception $e) {
            session()->flash('message', 'Something went wrong while creating the note!');
        }
        // reset form fields after creating note
        $this->reset(['title', 'content', 'recipient', 'sendDate']);
    }

    public function show($id)
    {
        $note = Note::where('id', $id)->first();
        $this->heartCount = $note->heart_count;

        if (!$note->is_published) {
            abort(404);
        }

        $this->dispatchBrowserEvent('swal:fire', [
            'title' => $note->title,
            'html' => '<div>
                    <img src="https://unsplash.it/400/200" width=600 height=200 class="mx-auto" /><br />
                    <p>'.$note->content.'</p><br />
                    <p>Sent from: '.$note->user->name.'</p>
                    <div class="flex justify-end mt-4 py-2">
                        <button class="bg-rose-400 hover:bg-rose-700 text-white font-bold py-2 px-4 flex items-center rounded" id="heartCountButton">
                            <ion-icon name="heart"></ion-icon>&nbsp;'.$this->heartCount.'
                        </button>
                    </div>
                </div>',
            'id' => $id,
            'heartCount' => $this->heartCount
        ]);
    }

    public function update()
    {
        $this->validate();
        $this->dispatchBrowserEvent('scrollToTop');

        try {
            $note = Note::findOrFail($this->noteId);
            $note->update([
                'title' => $this->title,
                'content' => $this->content,
                'recipient' => $this->recipient,
                'send_date' => $this->sendDate,
                'is_published' => $this->isPublished,
            ]);
            session()->flash('message', 'Note updated successfully.');
        }
        catch(\Exception $e) {
            session()->flash('message', 'Something went wrong while updating the note!');
        }

        $this->mount();
    }

    public function deleteConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Are you sure?',
            'text' => 'You are about to delete this note.',
            'id' => $id
        ]);
    }

    public function delete($id)
    {   
        try {
            $note = Note::where('id', $id)->first();
            $this->authorize('delete', $note);
            $note->delete();
            $this->mount();
        }
        catch(\Exception $e) {
            session()->flash('message', 'Something went wrong while deleting the note!');
        }
    }

    public function increaseHeartCount($id)
    {
        $this->heartCount++;
        $this->dispatchBrowserEvent('counterUpdated', ['heartCount' => $this->heartCount]);
        $note = Note::where('id', $id)->first()->update([
            'heart_count' => $this->heartCount
        ]);
    }

    public function render()
    {
        return view('livewire.notes');
    }
}
