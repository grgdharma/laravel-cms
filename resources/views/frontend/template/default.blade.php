@extends('layouts.frontend.app')

@section('title', $title.' | '.$page_title )
@section('page_title', $page_title )
@section('keywords',$meta_keywords)
@section('description',$description)
@section('meta_description',$meta_description)
@section('featured_image', asset($featured_image) )

@section('content')
<div class="content-detail">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('frontend.includes.top')
            <div class="row">
                <div class="leftcolumn">
                    <div class="card">
                        <h2> {{ $page_title }} </h2>
                        <div class="author-info">
                            @php
                                $author_info = getPostAuthor($post);
                            @endphp
                            <div class="author-image">
                                <div>
                                    @php 
                                        $author_avatar = $author_info !="" && $author_info->avatar !="" ?getImageURL($author_info->avatar): asset('admin/image/default-logo.png');
                                    @endphp
                                    <img src="{{ $author_avatar }}">						
                                </div>
                            </div>
                            <div class="post-meta"> 
                                <span class="author-name">{{ $author_info !="" ? $author_info->name:'Anonymous' }}, </span><span class="created-date"> {{ date('M d, Y', strtotime($post->created_at)) }}</span>
                            </div>
                        </div>
                        <img src="{{getImageURL($image)}}" class="img-responsive">
                        <div class="description">
                            {!! $description !!}
                        </div>

                        @include('frontend.template.comment')

                    </div>
                </div>
                @include('frontend.includes.sidebar')
            </div>
            @include('frontend.includes.footer')
        </div>
    </div>
</div>
@endsection
