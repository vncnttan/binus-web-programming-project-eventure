<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory<Event>
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
        $categories = DB::table('categories')->pluck('id')->toArray();
        $users = DB::table('users')->pluck('id')->toArray();

        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'date' => fake()->date(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'banner_image' => fake()->image(),
            'quota' => fake()->numberBetween(1, 100),
            'max_per_account' => fake()->numberBetween(1, 10),
            'is_online' => fake()->boolean(),
            'location' => fake()->address(),
            'user_id' => $users[array_rand($users)],
            'category_id' => $categories[array_rand($categories)],
        ];
    }
}
