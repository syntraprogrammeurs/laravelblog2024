@extends('layouts.admin')
@section('title')
    Edit Category
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">
        <form action="{{action('App\Http\Controllers\CategoryController@update', $category)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$category->name}}">
                @error('name')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <button type="submit" class="ms-auto btn btn-dark d-flex justify-content-end me-3">UPDATE</button>
        </form>
        @include('partials.form_error')
    </div>
@endsection
