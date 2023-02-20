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
                <div class="card">
                    <h2> {{ $page_title }} </h2>
                    <span>DRG, {{ date('M d, Y', strtotime($created_at)) }}</span>
                    <img src="{{getImageURL($image)}}" class="img-responsive">
                    <div class="">
                        {!! $description !!}
                    </div>
                </div>
            </div>
            @include('frontend.includes.sidebar')
        </div>
        @include('frontend.includes.footer')
    </div>
</div>
@endsection
