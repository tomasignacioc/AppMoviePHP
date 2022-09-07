<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string']
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $newUser = User::create($validateData);

        return $newUser;
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials))
        {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "token" => $token,
                "type" => "Bearer"
            ]);
        }

        return response()->json(["message" => "email or password doesn't match"], 404);
    }

    public function favorites(Request $request)
    {
        $user = User::find($request->user()->id);

        return $user->load('movies:id,title,image_url');
    }
}
