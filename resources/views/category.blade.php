@extends('layouts.frontend')
@section('content')
    {{--    @foreach($category->posts as $post)--}}
    {{--        <ul>--}}
    {{--            <a href="{{route('frontend.post', $post->slug)}}"><li>{{$post->id}} - {{$post->title}}</li></a>--}}

    {{--        </ul>--}}

    {{--    @endforeach--}}
    <!-- Breadcumb Area Start -->
    <div class="breadcumb-area section_padding_50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breacumb-content d-flex align-items-center justify-content-between">
                        <!-- Post Tag -->
                        <div class="gazette-post-tag">
                            <a href="{{route('category.category',$category->slug)}}">{{$category->name}}</a>
                        </div>
                        <p class="editorial-post-date text-dark mb-0">{{$category->created_at ? $category->created_at->diffForhumans() : 'no date'}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area End -->

    <!-- Editorial Area Start -->
    <section class="gazatte-editorial-area section_padding_100 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="editorial-post-slides owl-carousel">
                        @foreach($postTickers as $postTicker)
                            <!-- Editorial Post Single Slide -->
                            <div class="editorial-post-single-slide">
                                <div class="row">
                                    <div class="col-12 col-md-5">
                                        <div class="editorial-post-thumb">
                                            <img src="@if($postTicker->photo && !Str::startsWith($postTicker->photo->file, 'http'))
                    {{asset('assets/img/posts/'.$postTicker->photo->file)}}
                @else
                    {{$postTicker->photo->file ?? 'http://placehold.it/400x400'}}
                @endif" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <div class="editorial-post-content">
                                            <!-- Post Tag -->
                                            <div class="gazette-post-tag">
                                                <a href="{{route('category.category',$category->slug)}}">{{$category->name}}</a>
                                            </div>
                                            <h2><a href="#" class="font-pt mb-15">{{$postTicker->title}}</a></h2>
                                            <p class="editorial-post-date mb-15">{{$postTicker->created_at ? $postTicker->created_at->diffForhumans() : 'no date'}}</p>
                                            <p>{{Str::words($postTicker->body,20,'....')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Editorial Area End -->

    <section class="catagory-welcome-post-area section_padding_100">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-12 col-md-4">
                        <!-- Gazette Welcome Post -->
                        <div class="gazette-welcome-post">
                            <!-- Post Tag -->
                            <div class="gazette-post-tag">
                                <a href="{{route('category.category',$category->slug)}}">{{$category->name}}</a>
                            </div>
                            <h2><a href="#" class="font-pt mb-15">{{Str::words($post->title,5)}}</a></h2>
                            <p class="gazette-post-date">{{$post->created_at ? $post->created_at->diffForhumans() : 'no date'}}</p>
                            <!-- Post Thumbnail -->
                            <div class="blog-post-thumbnail my-5">
                                <img src="@if($post->photo && !Str::startsWith($post->photo->file, 'http'))
                    {{asset('assets/img/posts/'.$post->photo->file)}}
                @else
                    {{$post->photo->file ?? 'http://placehold.it/400x400'}}
                @endif" alt="post-thumb">
                            </div>
                            <!-- Post Excerpt -->
                            <p>{{Str::words($post->body,20,'....')}}</p>
                            <!-- Reading More -->
                            <div class="post-continue-reading-share mt-30">
                                <div class="post-continue-btn">
                                    <a href="{{route('frontend.post', $post->slug)}}" class="font-pt">Continue Reading
                                        <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach()

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="gazette-pagination-area">
                        {{$posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
