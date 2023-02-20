@extends('layouts.user.app')
@section('title', getTitle().' | My Account')
@section('content')

@include('user.includes.sidebar')
<div class="page-wrapper">
    @include('user.includes.topbar')
    <div class="page-content">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        Welcome {{Auth::user()->name}}, You are logged in!
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
