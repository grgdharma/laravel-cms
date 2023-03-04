@php $i=1; @endphp
@foreach($comments as $comment)

    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <div class="commenter-info">
            @if($comment->parent_id == null)<strong> {{ $i }}. </strong>@endif
            @if($comment->user_type =='user')
                <strong> {{ $comment->user->name }}</strong>
            @else
                <strong>{{ $comment->admin->name }} [Admin]</strong>
            @endif
            <span> 
                <a href="javascript:void(0);" onclick="return checkDelete({{$comment->id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                <form id="delete-{{$comment->id}}" action="{{ route('system.post.comment.delete', $comment->id) }}" method="POST" style="display:none">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                </form>
            </span>
            <div class="comment">{{ $comment->comment }}</div>
        </div>
        @guest
        @else
        <div class="comment-form">
            <form method="post" action="{{ route('system.post.comment.store') }}">
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
@php $i++; @endphp
@endforeach
<script type="text/javascript">
    function checkDelete(id){
        var x = confirm('Are you sure want to delete it?');
        if(x){
            document.getElementById('delete-'+id).submit();
        }
    }
</script>