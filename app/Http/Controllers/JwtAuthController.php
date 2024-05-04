<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;

// TO REFACTOR!!!

class JwtAuthController extends Controller
{
    // User Register (POST, formdata)
    public function register(Request $request){

        // data validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required"
        ]);

        // User Model
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        // Response
        return response()->json([
            "status" => true,
            "message" => __("auth.user_registered_successfully")
        ]);
    }

    // User Login (POST, formdata)
    public function login(Request $request){

        // data validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $csrfLength = env("CSRF_TOKEN_LENGTH");         // added token length
        $csrfToken = Random::generate($csrfLength);     // added token generation

        // JWTAuth
        $token = JWTAuth::claims(['X-XSRF-TOKEN' => $csrfToken])->attempt([  // added claims
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(empty($token)){

            return response()
                ->json([
                    "status" => false,
                    "message" => "Invalid details"
                ], Response::HTTP_UNAUTHORIZED);
        }

        // add cookies
        $ttl = env("JWT_COOKIE_TTL");   // added token expiry
        $tokenCookie = cookie("token", $token, $ttl);  // added jwt token cookie
        $csrfCookie = cookie("X-XSRF-TOKEN", $csrfToken, $ttl); // added csrf token cookie

        return response(["status" => true, "message" => __("auth.user_logged_in_successfully"), "user" => auth()->user()])
            ->withCookie($tokenCookie) // added cookies
            ->withCookie($csrfCookie); // added cookies
    }

    // User Profile (GET)
    public function profile(){
        $userdata = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Your profile",
            "data" => $userdata
        ]);
    }

    // To generate refresh token value
    public function refreshToken(){

        $csrfLength = env("CSRF_TOKEN_LENGTH");         // added token length
        $csrfToken = Random::generate($csrfLength);     // added token generation

        $currentToken = auth()->getToken();
        try{
            $newToken = JWTAuth::setToken($currentToken)
                ->claims(['X-XSRF-TOKEN' => $csrfToken])
                ->refresh();
        }catch (TokenInvalidException $e){
            return response()->json(['message' => 'Token is invalid'], Response::HTTP_UNAUTHORIZED);
        }

        $ttl = env("JWT_COOKIE_TTL");   // added token expiry
        $tokenCookie = cookie("token", $newToken, $ttl);  // added jwt token cookie
        $csrfCookie = cookie("X-XSRF-TOKEN", $csrfToken, $ttl); // added csrf token cookie

        return response(["message" => "Token refresh succcessfully"])
            ->withCookie($tokenCookie) // added cookies
            ->withCookie($csrfCookie); // added cookies
    }


    // User Logout (GET)
    public function logout(){

        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => __("auth.user_logged_out_successfully")
        ]);
    }
}
