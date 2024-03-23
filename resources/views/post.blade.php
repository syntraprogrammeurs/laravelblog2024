@extends('layouts.frontend')
@section('content')

    <section class="single-post-area">
        <!-- Single Post Title -->
        <div class="single-post-title bg-img background-overlay" style="background-image: url({{asset('assets/img/imgfront/bg-img/1.jpg')}});">
            <div class="container h-100">
                <div class="row h-100 align-items-end">
                    <div class="col-12">
                        <div class="single-post-title-content">
                            <!-- Post Tag -->
                            <div class="gazette-post-tag">
                                @foreach($post->categories as $category)
                                    <a href="#">{{$category->name}}</a>
                                @endforeach
                            </div>
                            <h2 class="font-pt">{{$post->title}}</h2>
                            <p>{{$post->created_at ? $post->created_at->diffForHumans() : now()->diffForHumans()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-post-contents">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="single-post-text">
                            <p>{{$post->body}}</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="single-post-thumb">
                            <img class="img-fluid w-100" src="@if ($post->photo && !Str::startsWith($post->photo->file, 'http'))
                                            {{ asset('assets/img/posts/' . $post->photo->file) }}
                                        @else
                                            {{ $post->photo->file ?? 'http://placehold.it/62x62' }}
                                       @endif" alt="">
                        </div>

                    </div>

                </div>
            </div>
        </div>
        @include('partials.comment')
    </section>


@endsection

