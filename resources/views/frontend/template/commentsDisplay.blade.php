@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <div class="commenter-info">
            <div class="author-info">
                <div class="author-image">
                    <div>
                        @php 
                            $author_avatar = $comment->user !="" && $comment->user->avatar !="" ?getImageURL($comment->user->avatar): asset('admin/image/default-logo.png');
                        @endphp
                        <img src="{{ $author_avatar }}">						
                    </div>
                </div>
                <div class="post-meta"> 
                    @if($comment->user_type =='user')
                    <span class="author-name">{{ $comment->user !="" ? $comment->user->name:'Anonymous' }}, </span><span class="created-date"> {{ date('M d, Y H:i:s', strtotime($comment->created_at)) }}</span>
                    @else
                    <span class="author-name">{{ $comment->admin !="" ? $comment->admin->name:'Anonymous' }}, </span><span class="created-date"> {{ date('M d, Y H:i:s', strtotime($comment->created_at)) }}</span>
                    @endif
                </div>
            </div>
            <div class="post-comment">{!! $comment->comment !!}</div>
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
        @include('frontend.template.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach