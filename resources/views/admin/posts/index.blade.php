@extends('layouts.admin')
@section('title')
    Posts | <span class="rounded bg-primary text-white display-6">{{$allPosts->total()}}</span>
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        @if(session('status'))
            <x-alert/>
        @endif
        <div class="d-flex">
            <a href="{{route('posts.index')}}" class="btn btn-dark m-2 rounded-end-pill me-1"><i
                    class="fa-solid fa-house"></i> Home</a>
            <a href="{{route('posts.create')}}" class="btn btn-primary m-2 rounded-end-pill"><i
                    class="fa-solid fa-plus"></i> Add Post</a>
        </div>

        <table class="table table-striped shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Author</th>
                <th>Category</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Deleted</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($allPosts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img width="62" height="62" src="
                           @if($post->photo && !Str::startsWith($post->photo->file, 'http'))
                            {{asset('assets/img/posts/'.$post->photo->file)}}
                            @else
                            {{$post->photo->file ?? 'http://placehold.it/62x62'}}
                           @endif" alt="{{$post->title}}">
                    </td>
                    <td>@if ($post->user_id && $post->user)
                            <a href="{{route('authors', $post->user->name)}}">
                                {{$post->user->name}}
                            </a>
                        @else
                            <p class="text-danger">
                                {{$post->user()->withTrashed()->first() ? $post->user()->withTrashed()->first()->name : "no name"}}</p>
                        @endif
                    </td>
                    <td>
                        @foreach($post->categories as $category)
                            <span
                                class="badge rounded-pill text-bg-primary">                                {{$category->name}}</span>
                        @endforeach
                    </td>
                    <td>{{$post->title}}</td>
                    <td>{{Str::limit($post->body,20)}}</td>
                    <td>{{$post->created_at ? $post->created_at->diffForHumans() : ''}}</td>
                    <td>{{$post->updated_at ? $post->updated_at->diffForHumans() : ''}}</td>
                    <td>{{$post->deleted_at ? $post->deleted_at->diffForHumans() : ''}}</td>
                    <td>
                        <div class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="postDropdown{{$post->id}}" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu shadow" aria-labelledby="postDropdown{{$post->id}}">
                                <a href="{{route('posts.show',$post)}}" class="dropdown-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Show
                                </a>
                                <a href="{{route('posts.edit',$post)}}" class="dropdown-item">

                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </a>
                                {{--                                    <a href="{{route('posts.destroy', $post)}}" class="dropdown-item">--}}
                                {{--                                        <i class="fa-solid fa-trash"></i>--}}
                                {{--                                        Delete--}}
                                {{--                                    </a>--}}
                                @if($post->deleted_at != null)
                                    <a class="dropdown-item" href="{{route('postrestore',$post)}}">
                                        <i class="fa-solid fa-rotate-left"></i>
                                        Restore
                                    </a>
                                @else
                                    <form action="{{route('posts.destroy',$post)}}" method="POST">
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
                {{ $allPosts->appends(['search'=> Request::get('search'), 'fields'=> Request::get('fields')])->links() }}
            </div>
        </div>
    </div>
@endsection


