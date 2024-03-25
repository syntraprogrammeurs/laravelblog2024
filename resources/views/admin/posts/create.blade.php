@extends('layouts.admin')
@section('title')
    Create Post
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">
        <form action="{{action('App\Http\Controllers\PostController@store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group mb-3">
                <input type="text" name="title" class="form-control" placeholder="Title">
                @error('title')
                    <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="">Categories</label>
                @foreach($categories as $category)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{$category->id}}" id="category{{$category->id}}"name="categories[]">
                        <label for="category{{$category->id}}" class="form-check-label">{{$category->name}}</label>
                    </div>
                @endforeach
                @error('categories')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="">Keywords</label>
                @foreach($keywords as $keyword)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{$keyword->id}}" id="category{{$keyword->id}}"name="keywords[]">
                        <label for="category{{$keyword->id}}" class="form-check-label">{{$keyword->name}}</label>
                    </div>
                @endforeach
                @error('keywords')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <textarea name="body" class="form-control" id="" cols="60" rows="10"></textarea>
                @error('body')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="file" name="photo_id" id="ChooseFile">
            </div>
            <button type="submit" class="ms-auto btn btn-dark d-flex justify-content-end me-3">SUBMIT</button>
        </form>
        @include('partials.form_error')
    </div>
@endsection
