@extends('layouts.frontend.app')

@section('title', $title.' | '.$page_title )
@section('page_title', $page_title )
@section('keywords',$meta_keywords)
@section('description',$description)
@section('meta_description',$meta_description)
@section('featured_image', asset($featured_image) )

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        @include('frontend.includes.top')
        <div class="row">
            <div class="leftcolumn">
                @if(count($post_lists) > 0)
                    @foreach ($post_lists as $post)
                        <div class="card">
                            <div class="post-thumbnail">
                                <a href="{{ route('post.detail',$post->slug) }}"> <img src="{{ getImageURL($post->image) }}" class="img-fluid"></a>
                            </div>
                            <h2><a href="{{ route('post.detail',$post->slug) }}">{{ $post->title }}</a></h2>
                            <span>Title description, {{ date('M d, Y', strtotime($post->created_at)) }}</span>
                            <div class="post-content">
                                {!! $post->meta_description !!}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <h5>Not found.</h5>
                    </div>
                @endif
            </div>
            @include('frontend.includes.sidebar')
        </div>
        @include('frontend.includes.footer')
    </div>
</div>
@endsection
