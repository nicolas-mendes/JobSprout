<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title' => fake()->jobTitle(),
            'salary' => fake()->numberBetween(45000, 200000), 
            'location' => fake()->country(),
            'schedule' => fake()->randomElement(['Full-Time','Part-Time','Flexible Schedule','First Shift','Second Shift','Third Shift','On-Site','Remote','Hybrid']),
            'url' => fake()->url(),
            'description' => fake()->text(255),
            'featured' => false,
        ];
    }
}
