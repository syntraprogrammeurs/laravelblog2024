<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::withTrashed()->paginate(50);
            return view('admin.categories.index',compact($categories));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name'=>['required', 'between:1,255'],
        ],[
            'name.required'=> 'Name is required',
        ]);
        Category::create($request);
        return view('admin.categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
          return view('admin.posts.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        request()->validate([
            'name'=>['required', 'between:1,255'],
        ],[
            'name.required'=> 'Name is required',
        ]);
        Category::updating($request);
        return view('admin.categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        try{
            $category->delete();
        }catch(ModelNotFoundException $error){
            return response()->json(['message'=>'Category not found'], 404);
        }
        return redirect()->route('categories.index')->with('status', 'Category Deleted!')->with('alert-type', 'danger');
        //redirect('/admin/posts');
    }
}
