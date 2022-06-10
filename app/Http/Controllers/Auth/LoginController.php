<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\ValidationException;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected $redirectTo = '/dashboard'; //Redirect after authenticate

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function username()
    {
        // $login = request()->input('username');

        // if(is_numeric($login)){
        //     $field = 'mobile_no';
        // } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        //     $field = 'email';
        // } else {
        //     $field = 'username';
        // }

        // request()->merge([$field => $login]);

        // return $field;
         return 'user_id'; 
    }

    public function login(Request $request) //Go web.php then you will find this route
    {
      
         $this->validate($request, [
            'user_id'   => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('user_id', 'password');
       
        if(Auth::attempt(['user_id' => $request->user_id, 'password' => $request->password])){
         return redirect()->intended('dashboard');
           
        }
        else{
           
            return view('auth.login')->with('error_msg',"User Id and Password not match");
        }
    }

 
   
  

     
}
