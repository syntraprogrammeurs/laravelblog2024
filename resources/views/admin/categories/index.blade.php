@extends('layouts.admin')
@section('title')
    Categories
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        @if(session('status'))
            <x-alert/>
        @endif
        <div class="d-flex">
            <a href="{{route('categories.index')}}" class="btn btn-dark m-2 rounded-end-pill me-1"><i
                    class="fa-solid fa-house"></i> All categories</a>
            <a href="{{route('categories.create')}}" class="btn btn-primary m-2 rounded-end-pill"><i
                    class="fa-solid fa-plus"></i> Create category</a>
        </div>

        <table class="table table-striped shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Deleted</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at ? $category->created_at->diffForHumans() : ''}}</td>
                    <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : ''}}</td>
                    <td>{{$category->deleted_at ? $category->deleted_at->diffForHumans() : ''}}</td>
                    <td>
                        <div class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="categoryDropdown{{$category->id}}" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu shadow" aria-labelledby="categoryDropdown{{$category->id}}">
                                <a href="{{route('categories.show',$category)}}" class="dropdown-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Show
                                </a>
                                <a href="{{route('categories.edit',$category)}}" class="dropdown-item">

                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </a>
                                @if($category->deleted_at != null)
                                    <a class="dropdown-item" href="{{route('categoryrestore',$category)}}">
                                        <i class="fa-solid fa-rotate-left"></i>
                                        Restore
                                    </a>
                                @else
                                    <form action="{{route('categories.destroy',$category)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa-solid fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12">
                {{ $categories->appends(['search'=> Request::get('search'), 'fields'=> Request::get('fields')])->links() }}
            </div>
        </div>
    </div>
@endsection


