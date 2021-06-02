<?php

namespace Domain\Database\Factories;

use Domain\Content\Enums\CommentExtraData;
use Domain\Content\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'      => $this->faker->text(100),
            'body'       => $this->faker->text(400),
            'extra_data' => [CommentExtraData::RATE => mt_rand(0, 5)],
        ];
    }
}
