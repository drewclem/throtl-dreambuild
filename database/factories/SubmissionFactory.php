<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'vehicle_year' => $this->faker->year,
            'vehicle_make' => $this->faker->word,
            'vehicle_model' => $this->faker->word,
            'why' => $this->faker->sentence,
            'throtl_username' => $this->faker->userName,
            'active_vip' => $this->faker->boolean,
            'car_info' => $this->faker->sentence,
            'dream_build' => $this->faker->sentence,
            'ig_post' => $this->faker->sentence,
            'fav_episode' => $this->faker->sentence,
            'social_media' => $this->faker->sentence,
            'terms_of_service' => $this->faker->boolean,
        ];
    }
}
