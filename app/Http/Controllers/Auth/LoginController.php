<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $providers = [
        'facebook','google','twitter'
    ];
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $this->validate($request, [
                'email' => 'required|string|email',
                'password' => 'required|string|min:8'
            ]
        );
        // attempt to log the user
        if($this->guard()->attempt(['email' => $request->email, 'password' => $request->password])){
            // if successful, the redirect to intend location
            $user = Auth::user(); 
            if ( isset($user->email_verified_at) && $user->email_verified_at !=NULL ) {
                return redirect()->intended(route('user.dashboard'));
            }else{
                Auth::logout();
                return redirect()->route('login')
                    ->withErrors([
                        'email' => 'Please verify your email address.',
                    ])->withInput();
            }
        }
        // if unsuccessful then redirect to back with form data
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => trans('auth.failed'),
            ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard(){
        return Auth::guard();
    }

    /**
     *  Social Login Controller
     */
    
    public function redirectToProvider($driver){
        
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }
        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }
    public function handleProviderCallback( $driver ){
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
        // check for email in returned user
        return empty( $user->email ) ? $this->sendFailedResponse("No email id returned from {$driver} provider.") : $this->loginOrCreateAccount($user, $driver);
    }

    protected function loginOrCreateAccount($providerUser, $driver){
        $verification_code = rand(999999,111111);
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();
        // if user already found
        if( $user ) {
            // update the avatar and provider that might have changed
            $user->update([
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
            // create a new user
            $user = User::create([
                'name'      => $providerUser->getName(),
                'email'     => $providerUser->getEmail(),
                'provider'  => $driver,
                'provider_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
                'password'      => Hash::make('password'.$verification_code),
                'verification_code' => $verification_code,
                'email_verified_at' => date('Y-m-d g:i:s')
            ]);
        }
        // login the user
        Auth::login($user, true);
        return $this->sendSuccessResponse();
    }

    protected function sendSuccessResponse(){
        return redirect()->route('user.dashboard');
    }

    protected function sendFailedResponse($msg = null){
        return redirect()->route('login')->withErrors(['error' => $msg ?: 'Unable to login, try with another provider to login.']);
    }
    private function isProviderAllowed($driver){
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }



}
