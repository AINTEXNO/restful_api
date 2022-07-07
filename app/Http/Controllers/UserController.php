<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     * Регистрация
     */
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->merge(['api_token' => '']);
        $user = User::create($request->all());

        return response()->json([
            "status" => true,
            "message" => "User {$user->full_name} successfully created"
        ]);
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     * Аутентификация
     */
    public function auth(LoginRequest $request)
    {
        $user = User::where('login', $request->login)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => false,
                "message" => "Invalid authorization data"
            ],401);
        }

        return response()->json([
            "status" => true,
            "token" => $user->api_token
        ]);
    }
}
