@extends('layouts.admin')
@section('title')
 {{$post->title}}
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        @if(session('status'))
            <x-alert/>
        @endif
       <div class="d-flex shadow-lg p-3 mb-5 bg-body-tertiary rounded">
           <img src="
                           @if($post->photo && !Str::startsWith($post->photo->file, 'http'))
                            {{asset('assets/img/posts/'.$post->photo->file)}}
                            @else
                            {{$post->photo->file ?? 'http://placehold.it/62x62'}}
                           @endif" alt="{{$post->title}}">
           <div class="mx-5">
               <p>Posted on {{$post->created_at ? $post->created_at->diffForhumans() : 'no date'}} by {{$post->user->name}}</p>
               @foreach($post->categories as $category)
                   {{$category->name}}
               @endforeach
               <p class="mt-3">{{$post->body}}</p>
           </div>
       </div>
    </div>
@endsection


