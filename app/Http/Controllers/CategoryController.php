<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
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
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = request()->validate([
            'name'=>['required', 'between:1,255'],
        ],[
            'name.required'=> 'Name is required',
        ]);
        Category::create($validatedData);

        return redirect()->action([CategoryController::class, 'index']);
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
          return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        // Voer validatie direct in de methode uit
        $validatedData = $request->validate([
            'name' => ['required', 'between:1,255'],
        ], [
            'name.required' => 'Name is required',
        ]);

        // Update de categorie met gevalideerde data
        $category->update($validatedData);

        // Redirect naar een pagina (bijvoorbeeld de lijst met categorieën) met een succesmelding
        return redirect()->route('categories.index')->with('status', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Category Deleted!');
    }
    public function restore(Category $category)
    {
        $category->onlyTrashed()->restore();
        return redirect()->route('categories.index')->with('status', 'Category Restored!')->with('alert-type', 'warning');
    }
    public function category(Category $category){
        $posts = $category->posts()->with(['photo', 'categories'])->latest()->take(6)->paginate(9);
        return view('category', compact('category','posts'));
    }

}
