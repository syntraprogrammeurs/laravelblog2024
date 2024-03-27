@extends('layouts.admin')
@section('title')
    Update Category
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">

        <form action="{{action('App\Http\Controllers\ProductCategoryController@update',$productcategory)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Title" value="{{$productcategory->name}}">
                @error('name')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <textarea name="description" class="form-control" id="description" cols="30" rows="10">
                    {{$productcategory->description}}
                </textarea>
                @error('description')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <button type="submit" class="ms-auto btn btn-dark d-flex justify-content-end me-3">SUBMIT</button>
        </form>
        @include('partials.form_error')
    </div>
@endsection
