<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function show_login_form() {
        $library = Library::query()->first();

        return view('login', compact('library'));
    }

    public function show_register_form() {
        $library = Library::query()->first();

        return view('register', compact('library'));
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
            'phone_number' => 'required|integer|digits:10', // Assuming a max of 10 digits for phone numbers
            'email' => 'email|unique:users',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::transaction(function() use ($data){
            $user = User::create($data);
            $user->roles()->attach(3);

            Auth::login($user);
        });

        return redirect('/');
    }
}

