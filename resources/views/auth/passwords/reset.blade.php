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
                    <form id="form-action" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" readonly="" >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" >
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" >
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default">{{ __('Reset Password') }}</button>
                        </div>
                        <div class="form-group text-center">
                            <label><a href="{{route('admin.login')}}"> <i class="fa fa-undo" aria-hidden="true"></i> Back </a></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection