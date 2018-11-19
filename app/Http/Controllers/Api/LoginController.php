<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
//        $data = DB::table('sys_users')->where('name', '15722948127')->first();
//        dd($data);
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = Auth::guard('jwt')->attempt($credentials)) {
                throw new ApiException(1008, '登录失败');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            throw new ApiException(1009, 'token创建失败');
        }

        $expire = Auth::guard('jwt')->setToken($token)->getPayload()->get('exp');
        $token = 'Bearer '.$token;

        return compact('token', 'expire');
    }
}
