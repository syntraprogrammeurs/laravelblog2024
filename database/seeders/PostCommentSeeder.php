<?php

namespace Database\Seeders;

use App\Models\PostComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Binnen de foreach lus worden alle comments opgehaald voor dezelfde post als de huidige comment en krijgen ze willekeurig een parent toegewezen. Dit gebeurt door middel van de where methode van de comment klasse die zoekt naar comments met dezelfde post_id en een id die lager is dan die van de huidige comment.
        //Deze comments worden vervolgens in willekeurige volgorde gesorteerd met behulp van de inRandomOrder() methode en de eerste comment wordt toegewezen als parent van de huidige comment.
        //Als er geen geschikte parent comment wordt gevonden, krijgt de huidige comment geen parent_id toegewezen en is deze null.
        $comments = PostComment::factory()->count(2000)->create();
        foreach($comments as $comment){
            $postcomments = PostComment::where('post_id', $comment->post_id)
                ->where('id',"<", $comment->id)
                ->inRandomOrder()
                ->first();
            $comment->parent_id = $postcomments ? $postcomments->id : null;
            $comment->save();
        }
    }
}
