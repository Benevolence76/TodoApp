<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthApiController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);
    }

    /**
     * Log in a user and return an access token.
     */
   // Log in a user and return an access token.
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    $user =Auth::attempt($credentials);

    if ($user) {
        $user = Auth::user();
        $user->tokens()->delete();
        // Generate a plain text access token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['user' => $user, 'access_token' => $token], 200);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}

public function logout() 
{
    // delete the currrently logged in user active token
}

}
