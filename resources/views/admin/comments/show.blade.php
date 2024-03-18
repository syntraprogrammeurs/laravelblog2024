@extends('layouts.admin')
@section('title')
    Comment
@endsection
@section('graph')
@endsection
@section('content')
    <div class="container-fluid px-4">
        <p class="shadow-lg p-3 mb-5 bg-body-tertiary rounded">Post Title:{{$post->title}}</p>
      <div class="accordion" id="accordionParentRoot">
          @include('components.comment',['comment'=>$comment])
      </div>
    </div>
@endsection





