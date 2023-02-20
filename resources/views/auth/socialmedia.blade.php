<div class="row justify-content-center">
    <div class="col-md-12 col-12">
        <p>Login with social media</p>
    </div>
    <div class="col-md-6 col-6">
        <button data-action-url="{{ route('social.oauth', 'facebook') }}" class="btn btn-facebook btn-social-login"> <i class="fa fa-facebook" aria-hidden="true"></i> Facebook</button>
    </div>
    <div class="col-md-6 col-6">
        <button data-action-url="{{ route('social.oauth', 'google') }}" class="btn btn-google btn-social-login"> <i class="fa fa-google" aria-hidden="true"></i> Google</button>
    </div>
</div>