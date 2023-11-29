<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        if (!$token = Auth::guard('api')->attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = Auth::guard('api')->user();
        $user['token'] = $token;
        $user->getRoleNames();
        return response()->json([
            'user' => $user,
            'token_type' => 'bearer',
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $token = Auth::guard('api')->login($user);
        $user['token'] = $token;
        return response()->json([
            'user' => $user,
            'token_type' => 'bearer',
        ]);
    }

    public function me()
    {
        // Get the authenticated User.
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return response()->json([
            'access_token' => auth()->refresh(),
        ]);
    }
}
