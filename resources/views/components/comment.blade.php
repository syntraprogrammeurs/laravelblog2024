@props(['comment'])
<div class="mb-2">
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{$comment->id}}">
            <button class="accordion-button collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse{{$comment->id}}" aria-expanded="false" aria-controls="collapse{{$comment->id}}">
                Commentaar #{{$comment->id}}
            </button>
        </h2>
        {{--inhoud--}}
        <div id="collapse{{$comment->id}}" class="accordion-collapse collapse"
            aria-labelledby="heading{{$comment->id}}" data-bs-parent="#accordionParent{{$comment->parent_id ?? 'Root'}}">
            <div class="accordion-body">
                <p>{{$comment->body}}</p>
                {{-- als bovenstaand commentaar children heeft dan zullen we ze hieronder
                weergeven met een ingesprongen section (indent)--}}
                @if($comment->children->isNotEmpty())
                    <div class="ms-3">
                        @foreach($comment->children as $child)
                            @include('components.comment',['comment'=>$child])
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
