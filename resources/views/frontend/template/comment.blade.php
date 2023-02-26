<div id="comment-section">
    @if (count($post->comments)>0)
        <h1>Display Comments</h1>
        @include('frontend.template.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
    @endif
    @guest
    <span>Please, <a href="{{ route('login') }}"> Login </a> to comment on the post. </span>
    @else
    <div class="comment-form">
        <h1>Add comment</h1>
        <form method="post" action="{{ route('comment.store') }}">
            @csrf
            <div class="form-group">
                <textarea class="form-control @error('comment') is-invalid @enderror" name="comment"></textarea>
                @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Add Comment" />
            </div>
            @include('frontend.includes.alert')
        </form>
    </div>
    @endguest
</div>