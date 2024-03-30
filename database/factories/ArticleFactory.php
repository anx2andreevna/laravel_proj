<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'datePublic' => $this->faker->date(),
            'title' => $this->faker->word(),
            'shortDesc' => $this->faker->sentence(),
            'desc' => $this->faker->text(),

        ];
    }
}
