@extends('layouts.admin')
@section('title')
    products
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        @if(session('status'))
            <x-alert/>
        @endif
        <div class="d-flex">
            <a href="{{route('products.index')}}" class="btn btn-dark m-2 rounded-end-pill me-1"><i
                    class="fa-solid fa-house"></i> Home</a>
            <a href="{{route('products.create')}}" class="btn btn-primary m-2 rounded-end-pill"><i
                    class="fa-solid fa-plus"></i> Add product</a>
        </div>

        <table class="table table-striped shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Brands</th>
                <th>Price</th>
                <th>Body</th>
                <th>Keywords</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td><img width="62" height="62" src="
                           @if($product->photo && !Str::startsWith($product->photo->file, 'http'))
                            {{asset('assets/img/products/'.$product->photo->file)}}
                            @else
                            {{$product->photo->file ?? 'http://placehold.it/62x62'}}
                           @endif" alt="{{$product->title}}">
                    </td>
                    <td>{{$product->name}}</td>
                    <td>
                       {{$product->brand->name ? $product->brand->name : 'no brand'}}
                    </td>
                    <td>{{$product->price}}</td>
                    <td>{{Str::limit($product->body,20)}}</td>
                    <td>
                        @foreach($product->keywords as $keyword)
                            <span
                                class="badge rounded-pill text-bg-primary">{{$keyword->name}}</span>
                        @endforeach
                    </td>
                    <td>{{$product->created_at ? $product->created_at->diffForHumans() : ''}}</td>
                    <td>{{$product->updated_at ? $product->updated_at->diffForHumans() : ''}}</td>
                    <td>
                        <div class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="productDropdown{{$product->id}}" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu shadow" aria-labelledby="productDropdown{{$product->id}}">
                                <a href="#" class="dropdown-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Show
                                </a>
                                <a href="#" class="dropdown-item">

                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </a>
                              </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection


