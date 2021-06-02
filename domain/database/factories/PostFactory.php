<?php

namespace Domain\Database\Factories;

use Domain\Content\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 1,
            'title'  => $this->faker->text(100),
            'slug'   => $this->faker->slug(10),
            'body'   => $this->faker->text(400),
        ];
    }
}
