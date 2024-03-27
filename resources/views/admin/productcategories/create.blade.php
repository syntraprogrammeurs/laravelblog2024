@extends('layouts.admin')
@section('title')
    Create Category
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">
        <form action="{{action('App\Http\Controllers\ProductCategoryController@store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Title">
                @error('name')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                @error('description')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <button type="submit" class="ms-auto btn btn-dark d-flex justify-content-end me-3">SUBMIT</button>
        </form>
        @include('partials.form_error')
    </div>
@endsection
