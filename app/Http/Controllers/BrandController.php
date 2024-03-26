<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Keyword;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = Brand::paginate(10);
        return view('admin.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.brands.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => ['required', 'between:3,255'],
            'description' => 'required',
        ], [
            'name.required' => 'Name is required',
            'name.between' => 'Name between 3 and 255 char required',
            'description.required' => 'Message is required',
        ]);

        Brand::create($request->all());
        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
        return view('admin.brands.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
