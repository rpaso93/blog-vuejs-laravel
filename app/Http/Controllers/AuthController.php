<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Auth;

class AuthController extends Controller
{
 
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'string|max:40|required',
            'password' => 'string|min:8|max:32|required'
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
           'result' => ['The provided user data is incorrect.'] 
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'string|max:40|required',
            'email' => 'string|max:255|email|required|unique:users,email',
            'password' => 'string|min:8|max:32|confirmed|required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    public function updatePassword(Request $request, $id)
    {
        //
    }

    public function closeAccount($id)
    {
        //
    }
}
