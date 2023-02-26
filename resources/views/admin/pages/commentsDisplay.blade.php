@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <div class="commenter-info">
            @if($comment->user_type =='user')
            <strong> {{ $comment->user->name }}</strong>
            @else
            <strong>{{ $comment->admin->name }} [Admin]</strong>
            @endif
            <p>{{ $comment->comment }}</p>
        </div>
        @guest
        @else
        <div class="comment-form">
            <form method="post" action="{{ route('comment.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="comment" class="form-control" />
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Reply" />
                </div>
            </form>
        </div>
        @endguest
        @include('admin.pages.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach