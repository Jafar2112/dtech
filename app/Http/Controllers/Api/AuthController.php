<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login(LoginRequest $loginRequest)
    {
        $response = $this->authService->login($loginRequest);
        return response($response, 201);
    }

    public function register(RegisterRequest $registerRequest)
    {
        $response  = $this->authService->register($registerRequest);
        return response($response,201);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return response('Logout',204);
    }
}
