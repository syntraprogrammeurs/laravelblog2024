<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        //in de migration van posts zit er een user_id en een photo_id
        $userIds=User::pluck('id')->toArray();//50
        $photoIds=Photo::pluck('id')->toArray();//10
        return[
            'user_id'=>fake()->randomElement($userIds),
            'photo_id'=>fake()->randomElement($photoIds),
            'title'=>fake()->sentence(),
            'body'=>fake()->paragraph()
        ];
    }
}