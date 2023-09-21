<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    function login(Request $request) {

        $credentials = $request->only([
            'email',
            'password',
            'device_name'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['email incorreto']
            ]);
        }

        // if($request->has('logout_all_devices')) $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }
}
