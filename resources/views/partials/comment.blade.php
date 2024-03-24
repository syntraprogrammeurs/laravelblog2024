<section class="gazette-post-discussion-area section_padding_100 bg-gray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <!-- Comment Area Start -->
                <div class="comment_area section_padding_50 clearfix">
                    <div class="gazette-heading">
                        <h4 class="font-bold">Discussion</h4>
                    </div>

                    <ol>
                        <!-- Single Comment Area -->
                        <li class="single_comment_area">
                            @foreach($post->comments as $comment)
                                <div class="comment-wrapper d-md-flex align-items-start">
                                    <!-- Comment Meta -->
                                    <div class="comment-author">
                                        <img src="@if ($comment->user->photo && !Str::startsWith($comment->user->photo->file, 'http'))
                                            {{ asset('assets/img/users/' . $comment->user->photo->file) }}
                                        @else
                                            {{ $post->photo->file ?? 'http://placehold.it/62x62' }}
                                       @endif" alt="">
                                    </div>
                                    <!-- Comment Content -->
                                    <div class="comment-content">
                                        <h5>{{$comment->id}}-{{$comment->user->name}}</h5>
                                        <span class="comment-date font-pt">{{$post->created_at ? $post->created_at->diffForHumans() : now()->diffForHumans()}}</span>
                                        <p>{{Str::limit($comment->body,50,'...')}}</p>
                                        <a class="reply-btn" href="#">Reply <i class="fa fa-reply" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            @endforeach
                                <ol class="children ms-4">

{{--                                        dit kan je gebruiken om recursief je child comments op te roepen.
dit kan een goede oefening zijn--}}
{{--                                       @include('partials.comment',['comment'=>$child])--}}

                                </ol>
                    </ol>
                </div>

            </div>
        </div>
    </div>
</section>
