@extends('layouts.admin')
@section('title')
    Comment
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        @if(session('status'))
            <x-alert/>
        @endif
        <div class="d-flex">
            <a href="{{route('comments.index')}}" class="btn btn-dark m-2 rounded-end-pill me-1"><i
                    class="fa-solid fa-house"></i> Home</a>
        </div>

        <table class="table table-striped shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            <thead>
            <tr>
                <th>Post ID</th>
                <th>Parent ID</th>
                <th>Comment ID</th>
                <th>Author</th>
                <th>Body</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Deleted</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>
                        <a href="{{route('posts.show', $comment->post->id)}}">
                            {{$comment->post->id}}
                        </a>

                    </td>
                    <td>
                        @if($comment->parent_id)
                            <a href="{{route('comments.show', $comment->parent_id)}}">
                                {{$comment->parent_id}}
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('comments.show', $comment)}}">
                            {{$comment->id}}
                        </a>
                    </td>
                    <td>{{$comment->user->name ? $comment->user->name : 'no name'}}</td>
                    <td>{{Str::limit($comment->body,20)}}</td>
                    <td>{{$comment->created_at ? $comment->created_at->diffForHumans() : ''}}</td>
                    <td>{{$comment->updated_at ? $comment->updated_at->diffForHumans() : ''}}</td>
                    <td>{{$comment->deleted_at ? $comment->deleted_at->diffForHumans() : ''}}</td>
                    <td>
                        <div class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="commentDropdown{{$comment->id}}" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu shadow" aria-labelledby="commentDropdown{{$comment->id}}">
                                <a href="{{route('comments.show',$comment)}}" class="dropdown-item">
                                    <i class="fa-solid fa-eye"></i>
                                    Show
                                </a>
                                <a href="{{route('comments.edit',$comment)}}" class="dropdown-item">

                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Edit
                                </a>

{{--                                @if($comment->deleted_at != null)--}}
{{--                                    <a class="dropdown-item" href="{{route('commentrestore',$comment)}}">--}}
{{--                                        <i class="fa-solid fa-rotate-left"></i>--}}
{{--                                        Restore--}}
{{--                                    </a>--}}
{{--                                @else--}}
{{--                                    <form action="{{route('comments.destroy',$comment)}}" method="comment">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="dropdown-item">--}}
{{--                                            <i class="fa-solid fa-trash"></i>--}}
{{--                                            Delete--}}
{{--                                        </button>--}}
{{--                                    </form>--}}
{{--                                @endif--}}
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection


