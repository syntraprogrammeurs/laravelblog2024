@extends('layouts.admin')
@section('title')
    Create Product
@endsection
@section('cards')
@endsection
@section('charts')
@endsection
@section('content')
    <div class="container-fluid px-4">
        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Name">
                @error('name')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="">Brands</label>
                    <select class="form-select" name="brands[]">
                        <option selected disabled>Choose here</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                @error('keywords')
                <p class="text-danger fs-6">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="">Product Categories</label>
                @foreach($productcategories as $productcategory)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="{{$productcategory->id}}" id="category{{$productcategory->id}}"name="keywords[]">
                        <label for="category{{$productcategory->id}}" class="form-check-label">{{$productcategory->name}}</label>
                    </div>
                @endforeach
                @error('productcategories')
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
            <div class="form-group mb-3">
                <input type="number" name="price" class="form-control" placeholder="Price" step="0.01" min="0" max="99999999.99">
                @error('price')
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
