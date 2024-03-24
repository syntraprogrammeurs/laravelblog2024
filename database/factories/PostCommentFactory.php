<?php

namespace Database\Factories;

use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostComment>
 */
class PostCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'post_id' =>Post::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,

            'body' => $this->faker->paragraph(),

        ];
    }
}
