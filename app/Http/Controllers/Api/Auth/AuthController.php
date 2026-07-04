<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    // LOGIN
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->error(null, 'Invalid credentials', 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken('admin-token')->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token,
        ], 'Login successful');
    }

    // LOGGED-IN USER INFO
    public function me(Request $request)
    {
        return $this->success($request->user(), 'User fetched successfully');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(null, 'Logged out successfully');
    }
}
