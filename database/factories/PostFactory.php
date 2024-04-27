<?php

namespace Database\Factories;

use Faker\Factory as Faker;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

//        $faker = Faker::create('ar_SA');
        return [
            'user_id' => User::inRandomOrder()->first()->id,

            'title' => [
                'en' => $this->faker->sentence,
                'ar' => $this->faker->sentence,
            ],
            'body' => [
                'en' => $this->faker->paragraph,
                'ar' => $this->faker->paragraph,
            ],

            'image' => $this->faker->imageUrl(640, 480, 'animals', true) // Generates random animal images
        ];
    }
}
