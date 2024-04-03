<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->get()->count() == 0) {
            User::factory()->count(5)->create();
        } 
        else { 
            echo "Unable to run the seed. The table is not empty."; 
            die(); 
        }
    }
}
