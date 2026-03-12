<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show_login_form() {
        return view('login');
    }

    public function show_register_form() {
        return view('register');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->only('document_number', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // redirecciona a donde estaba antes de entrar al login, sino, va a raiz
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'not_found' => 'Usuario o contraseña incorrectos.',
        ]);
    }

    public function register(Request $request) {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_number' => 'required|string|max:50',
            'phone_number' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create($data);

        Auth::login($user);

        return redirect('/');
    }
}

