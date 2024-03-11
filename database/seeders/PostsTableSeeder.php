<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $chunkSize = 1000;
        $postCount = 5000;

      $posts = Post::factory()->count($postCount)->make();
      $chunks = array_chunk($posts->toArray(), $chunkSize);

      foreach($chunks as $chunk){
          Post::insert($chunk);
      }
    }
}
