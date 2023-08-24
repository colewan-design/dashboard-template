<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        $user_data = (object) [];
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = Auth::user();
            Auth::login($user);
            $user_data = User::where('user_ref', $user->user_ref)->first();
            // generate token
            $token_hash = Hash::make($request->user_ref);
        } else {
            // failed login
            return $this->returnResponse(500, 'error', $user_data, 'Login failed');
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->returnResponse(200, 'success', $request->session()->token(), 'Logged out successfully');
    }
}
