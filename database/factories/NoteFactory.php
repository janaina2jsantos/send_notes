<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'recipient' => $this->faker->unique()->safeEmail(),
            'send_date' => $this->faker->dateTimeBetween('now', '+10days'),
            'is_published' => true,
            'heart_count' => $this->faker->numberBetween(0, 20)
        ];
    }
}
