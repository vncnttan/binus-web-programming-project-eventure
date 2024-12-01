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

        $name = $this->eventName();
        $imageLink = "https://picsum.photos/seed/".$name."/1200/800/";
        return [
            'name' => $name,
            'description' => fake()->sentence(),
            'date' => fake()->date(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'banner_image' => $imageLink,
            'quota' => fake()->numberBetween(1, 100),
            'max_per_account' => fake()->numberBetween(1, 10),
            'is_online' => fake()->boolean(),
            'location' => fake()->address(),
            'user_id' => $users[array_rand($users)],
            'category_id' => $categories[array_rand($categories)],
        ];
    }

    public function eventName()
    {
        $eventPrefixes = [
            'International',
            'Global',
            'Annual',
            'World',
            'National',
            'Regional',
            'Virtual',
            'Hybrid',
        ];

        $eventDomains = [
            'Technology',
            'Innovation',
            'Digital Transformation',
            'Artificial Intelligence',
            'Machine Learning',
            'Cybersecurity',
            'Cloud Computing',
            'Data Science',
            'Blockchain',
            'Sustainability',
            'Climate Change',
            'Renewable Energy',
            'Healthcare',
            'Medical Research',
            'Biotechnology',
            'Business',
            'Entrepreneurship',
            'Marketing',
            'Leadership',
            'Education',
            'Research',
            'Social Impact',
        ];

        $prefix = $eventPrefixes[array_rand($eventPrefixes)];
        $domain = $eventDomains[array_rand($eventDomains)];

        return sprintf('%s %s %s', $prefix, $domain, date('Y'));
    }
}
