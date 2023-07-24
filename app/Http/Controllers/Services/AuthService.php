<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends Controller
{
    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            if (Hash::check($data['password'], $user->password,)) {
                Auth::login($user);
                return redirect()->route('index');
            } else {
                return  "password";
            }
        } else {
            return  "email";
        }

        return "error";
    }

    public function logout()
    {
        $user = auth()->user();
        if ($user) {
            Auth::logout($user);
            return redirect()->route('index');
        }
    }
}
