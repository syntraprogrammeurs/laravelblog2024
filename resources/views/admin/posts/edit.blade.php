@extends('layouts.admin')
@section('title')
    Edit Post
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">
        <form action="{{action('App\Http\Controllers\PostController@update',$post)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{$post->title}}">
                        @error('title')
                        <p class="text-danger fs-6">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Categories</label>
                        @foreach($categories as $category)
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    value="{{$category->id}}"
                                    id="category{{$category->id}}"
                                    name="categories[]"
                                    @if($post->categories->contains($category->id))
                                        checked
                                    @endif
                                >
                                <label for="category{{$category->id}}" class="form-check-label">{{$category->name}}</label>
                            </div>
                        @endforeach
                        @error('categories')
                        <p class="text-danger fs-6">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                <textarea name="body" class="form-control" id="" cols="60" rows="10">
                    {{$post->body}}
                </textarea>
                        @error('body')
                        <p class="text-danger fs-6">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="file" name="photo_id" id="ChooseFile">
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid img-thumbnail" src="{{$post->photo ? asset('assets/img/posts/' .
                                    $post->photo->file) : 'http://placehold.it/400x400'}}" alt="{{$post->name}}">

                </div>
                <div class="col-md-12">
                    <button type="submit" class="ms-auto btn btn-dark d-flex justify-content-end me-3">UPDATE</button>
                </div>

            </div>
        </form>
        @include('partials.form_error')
    </div>
@endsection
