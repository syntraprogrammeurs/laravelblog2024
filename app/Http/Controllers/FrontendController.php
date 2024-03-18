<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index(){
        $postTickers = Post::latest('created_at')->take(6)->get();
        return view('home',compact('postTickers'));
    }
}
