@extends('layouts.user.auth.app')
@section('title','User | Email Verification')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12">
            <div id="reg-login-form" class="login-form shadow-lg">
                <div class="card-body">
                    <div class="form-logo">
                        @include('layouts.logo')
                    </div>
                    <h6 class="card-title"> Verify Your Email Address  </h6>
                    <p>We have sent you a verification code. Please check you email.</p>
                    @if (session('status'))
                        <div class="text-danger">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form id="form-action" autocomplete="off" method="POST" action="{{ route('verification.confirm') }}" >
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <div class="form_group mb-4">
                            <input type="number" class="form-control" placeholder="Verification Code" name="verification_code" min="6" >
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-default btn_secondary btn-process"> Submit </button> 
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
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Verify');
        return true;
    });
</script>
@endsection