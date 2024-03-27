@extends('layouts.admin')
@section('title')
    Productcategories
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        @if(session('status'))
            <x-alert/>
        @endif
        <div class="d-flex">
            <a href="{{route('productcategories.index')}}" class="btn btn-dark m-2 rounded-end-pill me-1"><i
                    class="fa-solid fa-house"></i> All productcategories</a>
            <a href="{{route('productcategories.create')}}" class="btn btn-primary m-2 rounded-end-pill"><i
                    class="fa-solid fa-plus"></i> Create productcategory</a>
        </div>

        <table class="table table-striped shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productcategories as $productcategory)
                <tr>
                    <td>{{$productcategory->id}}</td>
                    <td>{{$productcategory->name}}</td>
                    <td>{{Str::words($productcategory->description,20,'...')}}</td>
                    <td>{{$productcategory->created_at ? $productcategory->created_at->diffForHumans() : ''}}</td>
                    <td>{{$productcategory->updated_at ? $productcategory->updated_at->diffForHumans() : ''}}</td>
                    <td>
                        <div class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="productcategoryDropdown{{$productcategory->id}}" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu shadow" aria-labelledby="productcategoryDropdown{{$productcategory->id}}">
                                <a href="{{route('productcategories.show',$productcategory)}}" class="dropdown-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Show
                                </a>
                                <a href="{{route('productcategories.edit',$productcategory)}}" class="dropdown-item">

                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </a>
                                    <form action="{{route('productcategories.destroy',$productcategory)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa-solid fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>

                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12">
                {{ $productcategories->links() }}
            </div>
        </div>
    </div>
@endsection


