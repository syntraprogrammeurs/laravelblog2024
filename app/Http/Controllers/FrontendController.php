<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index(){
        // Eager load de relaties 'photo' en 'categories' samen met de laatste post
        $featuredPost = Post::with(['photo', 'categories'])->latest()->first();

        // Eager load de relaties 'photo' en 'categories' voor de post tickers
     //   $postTickers = Post::with(['photo', 'categories'])->latest('created_at')->take(6)->get();

      //  $postCategories = Category::all();

        return view('home', compact( 'featuredPost'));
    }
}



