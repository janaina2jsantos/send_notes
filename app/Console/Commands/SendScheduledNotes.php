<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmail;
use App\Models\Note;
use Carbon\Carbon;

class SendScheduledNotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-notes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $notes = Note::where('is_published', true)
            ->whereDate('send_date', Carbon::today())
            ->get();

        if (!$notes->count()) {
            $this->info("You don't have any notes to send today.");
        }

        foreach ($notes as $note) {
            SendEmail::dispatch($note);
            $this->info("You've sent " . $notes->count() . " note(s). Please, check the laravel log.");
        }
    }
}
