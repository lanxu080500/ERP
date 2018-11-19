<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use App\Util\AuthUtil;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtToken
{
    /**
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (! $token = Auth::setRequest($request)->getToken()) {
            Log::error('[Auth][Api] no token in request[' . json_encode($request) . ']');
            throw new ApiException(1001, trans("api.error.token_not_provide"), array(), 401);
        }
        //Log::info('token: ' . $token);
        try {
            $payload = AuthUtil::checkOrFail('point');
        } catch (TokenExpiredException $e) {
            throw new ApiException(1002, trans("api.error.token_expire"), array(), 401);
        } catch (JWTException $e) {
            throw new ApiException(1003, trans("api.error.token_invalid"), array(), 401);
        }

        if (! $payload) {
            throw new ApiException(1006, trans("api.error.user_not_exist"), array(), 404);
        }

        return $next($request);
    }
}
