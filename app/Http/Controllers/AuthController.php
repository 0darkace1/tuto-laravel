<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function signIn(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route("blog.index"));
        }

        return to_route("auth.login")->withErrors([
            "email" => "Email ou Mot de passe invalide"
        ])->onlyInput('email');
    }

    public function register()
    {
        return view("auth.register");
    }

    public function signUp(RegisterRequest $request)
    {
        $validatedRequest = $request->validated();

        // Hash the password before saving it to the database
        $validatedRequest["password"] = Hash::make($validatedRequest["password"]);
        // We don't need the password_confirmation field in the database
        unset($validatedRequest["password_confirmation"]);

        // Create a new user
        $user = User::create($validatedRequest);

        // Log the user in
        Auth::login($user);

        return redirect(route("blog.index"));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect(route("auth.login"));
    }
}
