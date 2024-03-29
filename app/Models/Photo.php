<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'file',
    ];
    protected $uploads = 'assets/img/';

//    public function getFileAttribute($photo){
//        return $this->uploads . $photo;
//    }

    /* Relations */
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function photo(){
        return $this->belongsTo(Post::class);
    }
}
