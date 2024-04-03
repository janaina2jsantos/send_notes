<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Note;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('notes')->get()->count() == 0) {
            User::all()->each(function(User $user) {
                Note::factory()->count(5)->create([
                    'user_id' => $user->id
                ]);
            });
        } 
        else { 
            echo "Unable to run the seed. The table is not empty.";
            die(); 
        }
    }
}
