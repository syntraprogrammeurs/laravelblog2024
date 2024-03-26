
@extends('layouts.admin')
@section('title')
    brands
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        @if(session('status'))
            <x-alert/>
        @endif
        <div class="d-flex">
            <a href="{{route('brands.index')}}" class="btn btn-dark m-2 rounded-end-pill me-1"><i
                    class="fa-solid fa-house"></i> Home</a>
            <a href="{{route('brands.create')}}" class="btn btn-primary m-2 rounded-end-pill"><i
                    class="fa-solid fa-plus"></i> Add brand</a>
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
            @foreach($brands as $brand)
                <tr>
                    <td>{{$brand->id}}</td>
                    <td>{{$brand->name}}</td>
                    <td>{{Str::limit($brand->description,20)}}</td>
                    <td>{{$brand->created_at ? $brand->created_at->diffForHumans() : ''}}</td>
                    <td>{{$brand->updated_at ? $brand->updated_at->diffForHumans() : ''}}</td>
                    <td>
                        <div class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="brandDropdown{{$brand->id}}" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu shadow" aria-labelledby="brandDropdown{{$brand->id}}">
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
                {{ $brands->links() }}
            </div>
        </div>
    </div>
@endsection


