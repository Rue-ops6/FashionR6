<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


     
    private function generateRandomImage($path)
    {
        $files = scandir($path);
        $files = array_diff($files, array('.', '..'));

        return fake()->randomElement($files);
    }


    public function definition(): array
    {
        return [
            'prodTitle' => fake()->randomElement(['dresses', 'beverage', 'pots']),
            'price' => fake()->randomFloat(1),
            'description' => fake()->text(),
            'pub' => fake()->numberBetween(0, 1),
            #'image' => basename(fake()->image(public_path('assets/images/product'))),
            'image' => $this->generateRandomImage(public_path('assets/images/product')),        
        ];
    }
}
