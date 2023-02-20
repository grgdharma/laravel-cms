@extends('layouts.admin.auth.app')
@section('title','Administration | Login')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12">
            <div id="reg-login-form" class="login-form shadow-lg">
                <div class="card-body">
                    <div class="form-logo">
                        @include('layouts.logo')
                    </div>
                    <h6 class="card-title">Administration | Login  </h6>
                    <form id="login-form" method="POST" action="{{ route('admin.login') }}">
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
                            <label><a href="{{route('admin.password.request')}}"> Forgot Your Password? </a></label>
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
        $('#login-form').submit();
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Login');
        return true;
    });
</script>
@endsection