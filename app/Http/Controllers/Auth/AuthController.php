<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\AuthFormRequest;

use Session; 
use Carbon\Carbon;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
   use AuthenticatesAndRegistersUsers, ThrottlesLogins;

protected $loginPath = '/hrm';
protected $redirectPath = '/hrm/home';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogout() {
   
        Session::flush();
        Auth::logout();
    
   return redirect()->intended('/hrm');
}

 public function errorLogout() {
   
        Session::flush();
        Auth::logout();
    
   return redirect()->intended('/hrm')->withErrors(['Technical Error. Contact Administrator']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    
    public function authenticate(AuthFormRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');
        if (Auth::attempt(['email' =>$email , 'password' =>$password , 'active' => 1], $remember))  
          {
             $user=Auth::user();
             $user->last_login =  Carbon::now(); 
             $user->save();   
            return redirect()->intended('/hrm/home');  
          }
        else
            return redirect()->intended('/hrm')->withErrors(['Authentication Failed']); 
    }
}
