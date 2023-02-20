<?php

namespace App\Http\Controllers\Auth;
use Mail;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\EmailVerificationMail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'mobile' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $verification_code = rand(999999,111111);
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'verification_code' => $verification_code,
        ]);
        // Send Verification Mail
        try{
            Mail::send(new EmailVerificationMail($user));
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        session()->put('user_id',$user->id);
        return $user;
    }

    /**
    *
    * Override the registered method from RegistersUsers
    */
    protected function registered(Request $request, $user){
        $this->guard()->logout();
        return redirect('/verification');
    }
    // Verification 
    public function showVerificationForm(){
        $user_id = session()->get('user_id');
        if($user_id !=''){
            return view('auth.verification')->with('user_id',$user_id);
        }else{
            return redirect('/register');
        }
    }
    public function verification_confirm(Request $request){
        $input = $request->all();
        $user_id = $request->input('user_id');
        $verification_code = $request->input('verification_code');
        if($verification_code !=''){
            $user = User::where('id',$user_id)->where('verification_code',$verification_code)->update(['email_verified_at' => date('Y-m-d g:i:s')]);
            if($user){
                session()->forget('user_id');
                return redirect('/login')->with('status', 'Your account verified successfully. Please Login');
            }else{
                return redirect('/verification')->with('status', 'Enter valid verification code');
            }
        }else{
            return redirect('/verification')->with('status', 'Verification code required');
        }
    }


}
