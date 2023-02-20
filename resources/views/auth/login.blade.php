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
                    <h6 class="card-title"> User | Login  </h6>
                    <form id="form-action" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" >
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default btn-login"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Login</button>
                        </div>
                        <div class="form-group text-center">
                            <label><a href="{{route('password.request')}}"> Forgot Your Password? </a></label>
                        </div>
                        <div class="form-group text-center">
                            @include('auth.socialmedia')
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
    $(document).on("click",".btn-login",function(e){
        e.preventDefault();
        $('#form-action').submit();
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Login');
        return true;
    });
    $(document).on("click",".btn-social-login",function(e){
        e.preventDefault();
        var action_url = $(this).data('action-url');
        $(location).attr('href', action_url);
    });
</script>
@endsection