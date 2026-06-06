<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BaseController;

class AuthController extends BaseController
{
    public function register(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'token' => $token,
            ],
            'User registered',
            201
        );
    }

    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $req->email)->first();

        if (!$user || !Hash::check($req->password, $user->password)) {
            return $this->error(
                'The provided credentials are incorrect.',
                401
            );
        }

        // Hapus token lama
        $user->tokens()->delete();

        $token = $user->createToken('api-token')->plainTextToken;

        return $this->success(
            [
                'user' => $user,
                'token' => $token,
            ],
            'User logged in'
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(
            null,
            'User logged out'
        );
    }
}