<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('email', 'samirsabiee@gmail.com')->first()->id,
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'image' => 'https://picsum.photos/id/' . $this->faker->numberBetween(1, 200) . '/400'
        ];
    }
}
