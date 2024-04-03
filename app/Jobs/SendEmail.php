<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Note;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $note;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $noteUrl = config('app.url') . '/notes/' . $this->note->id;
        $body = '<div>
                    <img src="https://unsplash.it/400/200" width=600 height=200 class="mx-auto" /><br />
                    <h2>'.$this->note->title.'</h2><br />
                    <p>'.$this->note->content.'</p><br />
                    <p>Sent from: '.$this->note->user->name.'</p>
                    <p>Date: '.$this->note->send_date->format('d/m/Y').'</p>
                </div>';

        $emailContent = "Hello, you've received a new note. View it here: {$body}";

        Mail::raw($emailContent, function($message) {
            $message->from('sendnotes@zimfy.co', 'The Sendnotes App')
                ->to($this->note->recipient)
                ->subject('You have a new note from ' . $this->note->user->name);
        });
    }
}
