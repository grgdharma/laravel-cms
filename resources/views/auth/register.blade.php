@extends('layouts.user.auth.app')
@section('title','User | Login')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12">
            <div id="reg-login-form" class="login-form shadow-lg">
                <div class="card-body">
                    <div class="form-logo">
                        @include('layouts.logo')
                    </div>
                    <h6 class="card-title"> User | Register  </h6>
                    <form id="form-action" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input  type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number" >
                            @error('mobile')
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
                            <button type="submit" class="btn btn-default btn-process">Register</button>
                        </div>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    
    $(document).on("click",".btn-process",function(e){
        e.preventDefault();
        $('#form-action').submit();
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Register');
        return true;
    });

    $(document).on("click",".btn-social-login",function(e){
        e.preventDefault();
        var action_url = $(this).data('action-url');
        $(location).attr('href', action_url);
    });
</script>
@endsection