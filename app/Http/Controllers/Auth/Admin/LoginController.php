<?php

namespace App\Http\Controllers\Auth\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Display the form to request a login.
     *
     * @return \Illuminate\Http\Response
     */

    public function showLogin(){

        return view('auth.admin.login');
    }

    /**
     * Login request process to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        // attempt to log the user
        if($this->guard()->attempt($request->only('email','password'))){
            // if successful, the redirect to intend location
            return redirect()->intended(route('admin.dashboard'));
        }
        // if unsuccessful then redirect to back with form data
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => trans('auth.failed'),
            ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request){
        $admin = $this->guard()->user();
        if (!empty($admin)) {
            $this->guard()->logout();
        }
        return redirect()->route('admin.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

}
