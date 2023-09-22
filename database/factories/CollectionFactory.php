<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'open_date' => $this->faker->dateTime,
            'close_date' => $this->faker->dateTime,
            'company_id' => \App\Models\Company::factory(),
            'cta' => $this->faker->word,
            'subtitle' => $this->faker->word,
            'lowerBanner' => $this->faker->word,
        ];
    }
}
