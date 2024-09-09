<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'          => fake()->word(),
            'description'    => fake()->text(100),
            'date_and_time'  => now()->addDay(),
            'location'       => fake()->text(100),
            'price'          => fake()->randomElement([1000,2000,3000]),
            'attendee_limit' => fake()->randomElement([10,5,20]),
            'user_id'        => User::factory()
        ];
    }
}
