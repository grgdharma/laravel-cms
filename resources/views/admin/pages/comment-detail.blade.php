@extends('layouts.admin.app')
@section('title','Page | Lists')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">
		<div class="card">
            <div class="card-header">
                <h1 class="post-title"> {{ $post->title }} </h1>
            </div>
            <div class="card-body">
               @include('admin.pages.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
            </div>
   		</div>
                
    </div>
</div>
@endsection