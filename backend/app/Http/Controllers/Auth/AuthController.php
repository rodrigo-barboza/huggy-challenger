<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class AuthController
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        return response()->json([
            'user' => $user = User::create($request->validated()),
            'token' => $user->createToken('auth-token')->plainTextToken,
        ], JsonResponse::HTTP_CREATED);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        /** @var User $user */
        $user = Auth::user();

        return response()->json([
            'message' => 'Authenticated',
            'user' => $user,
            'token' => $user->createToken('auth-token')->plainTextToken,
        ], JsonResponse::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ], JsonResponse::HTTP_OK);
    }
}
