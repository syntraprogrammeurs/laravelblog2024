@extends('layouts.admin')
@section('title')
    Posts
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        @if(session('status'))
            <x-alert/>
        @endif
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
                        <td>@if ($post->user_id && $post->user)                                           {{$post->user->name}}
                            @else
                                <p class="text-danger">
                                    {{$post->user()->withTrashed()->first() ? $post->user()->withTrashed()->first()->name : "no name"}}</p>
                            @endif
                        </td>
                        <td>
                            @foreach($post->categories as $category)
                                <span class="badge rounded-pill text-bg-primary">                                {{$category->name}}</span>
                            @endforeach
                        </td>
                        <td>{{$post->title}}</td>
                        <td>{{Str::limit($post->body,20)}}</td>
                        <td>{{$post->created_at ? $post->created_at->diffForHumans() : ''}}</td>                        <td>{{$post->updated_at ? $post->updated_at->diffForHumans() : ''}}</td>                        <td>{{$post->deleted_at ? $post->deleted_at->diffForHumans() : ''}}</td>                        <td>Actions</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12">
                {{ $allPosts->links() }}
            </div>
        </div>
    </div>
@endsection


