<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Str;            
use Usarise\Identicon\Identicon;        
use Usarise\Identicon\Image\Svg\Canvas as SvgCanvas;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employerName = fake()->name();

        $identicon = new Identicon(
            new SvgCanvas(), 
            144,
        );

        $imageContent = (string) $identicon->generate($employerName);

        $logoPath = 'logos/' . Str::random(40) . '.svg';
        Storage::disk('public')->put($logoPath, $imageContent);

        return [
            'name' => $employerName,
            'logo' => $logoPath,
            'email' => fake()->companyEmail(),
            'user_id' => User::factory(),
            'description' => fake()->text(255),
        ];
    }
}
