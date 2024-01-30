<?php

namespace App\Http\Controllers\Api\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthService
{
    public function login($fields)
    {
        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'User not found!'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'token' => $token,
        ];

    }

    public function register($fields)
    {
        $user = User::create([
            'name' => $fields['name'],
            'surname' => $fields['surname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'id' => $user->id,
            'name' => $user->name,
            'surname' => $user->surname,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'created_at' => $user->created_at,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout($request)
    {
        $user = Auth::user();

        if ($user) {
            $token = $request->bearerToken();

            $accessToken = PersonalAccessToken::findToken($token);

            if ($accessToken && $accessToken->tokenable_id === $user->id) {
                $accessToken->delete();

                return response()->json(['message' => 'Token başarıyla silindi']);
            }
        }

        return response()->json(['message' => 'Successfully logged out']);
    }
}
