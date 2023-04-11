<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'exists:users'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();
    
        if (!$user || $user->role !== "doctor" || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => 'User Not Found',
            ]);
        }

        $data = [
            "token" => $user->createToken($request->header('user-agent'))->plainTextToken
        ];
        return response()->json($data, 200);;
    }
}
