@extends('layouts.user.auth.app')
@section('title','User | Reset password')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12">
            <div id="reset-form" class="shadow-lg">
                <div class="card-body">
                    <div class="form-logo">
                        @include('layouts.logo')
                    </div>
                    <h6 class="card-title">Reset Password </h6>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="form-action" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default">{{ __('Send Reset Link') }}</button>
                        </div>
                        <div class="form-group text-center">
                            <label><a href="{{route('login')}}"> <i class="fa fa-undo" aria-hidden="true"></i> Back </a></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection