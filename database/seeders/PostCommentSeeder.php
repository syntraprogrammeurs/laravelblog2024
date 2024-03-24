<?php

namespace Database\Seeders;

use App\Models\PostComment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset de auto-increment waarde van de postcomments tabel naar 1
        DB::statement('ALTER TABLE post_comments AUTO_INCREMENT = 1;');
        $comments = PostComment::factory()->count(2000)->create();
        foreach ($comments as $comment) {

            $postcomments = PostComment::where('post_id', $comment->post_id)->where('id', "<", $comment->id)->inRandomOrder()->first();
            $comment->parent_id = $postcomments ? $postcomments->id : null;
            $comment->save();
        }
    }
}
