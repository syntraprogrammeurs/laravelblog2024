<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $allPosts = Post::with(['categories','user','photo'])->filter(request('search'),request('fields'))->paginate(50);
        return view('admin.posts.index',[
            'allPosts'=>$allPosts,
            'fillableFields'=>Post::getFillableFields()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
           'title'=>['required', 'between:5,255'],
           'categories'=>['required', Rule::exists('categories', 'id')],
           'body'=>'required'
        ],[
            'title.required'=> 'Titel is required',
            'title.between'=> 'Title between 5 and 255 char required',
            'body.required'=> 'Message is required',
            'categories.required'=> 'Please check minimum one category'
        ]);

        //post_id, user_id, title, body
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->body = $request->body;

        //photo
        if($file = $request->file('photo_id')){

        }
    }

    /**
     * Display the specified resource.
     */
//    public function show($id) //tem laravel 7
//    {
//        //
//        $post = Post::findOrFail($id);
//        return view('admin.posts.show',compact('post'));
//    }

    public function show(Post $post)
    {
        //
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function indexByAuthor(User $author){
        $allPosts = $author->posts()->paginate(20);
        return view('admin.posts.index',compact('allPosts'));
    }


}
