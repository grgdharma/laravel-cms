@extends('layouts.admin.app')
@section('title','Dashboard')
@section('content')

@include('admin.includes.sidebar')
<div class="page-wrapper">
    @include('admin.includes.topbar')
    <div class="page-content">
        <div class="row">
            <div class="col-md-8">
                Welcome {{Auth::user()->name}}, you are logged in!  
            </div>

        </div>
    </div>
</div>
@endsection
