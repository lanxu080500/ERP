<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function postLogin(Request $request)
    {
        $name = $request->input('username');
        $password = $request->input('password');
//        if( empty($remember)) {  //remember表示是否记住密码
//            $remember = 0;
//        } else {
//            $remember = $request->input('remember');
//        }
        //如果要使用记住密码的话，需要在数据表里有remember_token字段
//        if (Auth::attempt(['name' => $name, 'password' => $password], $remember)) {
//            dd(333);
//            return redirect()->intended('/welcome');
//        }
        if (Auth::attempt(['name' => $name, 'password'=>$password])) {
            return view('welcome');
        }
        return redirect('login')->withInput($request->except('password'));
    }

}
