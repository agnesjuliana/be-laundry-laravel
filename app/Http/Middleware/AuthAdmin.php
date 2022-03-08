<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $header = $request->header('Authorization');
            if ($header == null) {
                return response([
                    "message" => "Access denied",
                    "err" => null
                ], 403);
            }

            $token = explode(' ', $header)[1];
            $user = User::where("token", $token)->first();

            if ($user == null) {
                return response([
                    "message" => "Token expired",
                    "err" => $token
                ], 409);
            }

            if ($user["role"] == "admin") {
                return $next($request);
            } else {
                return response([
                    "message" => "Access denied, you don't have privillege",
                    "err" => $token
                ], 403);
            }
        } catch (\Exception $th) {
            return response([
                "message" => "auth error",
                "err" => $th->getMessage()
            ], 500);
        }
    }
}
