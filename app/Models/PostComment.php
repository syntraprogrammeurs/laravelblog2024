<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PostComment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['post_id','user_id', 'body', 'parent_id'];

    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    //parent comment relation
    public function parent(){
        return $this->belongsTo(PostComment::class,'parent_id');
    }
    //Child comments relation
    public function children(){
        return $this->hasMany(PostComment::class, 'parent_id');
    }

}
