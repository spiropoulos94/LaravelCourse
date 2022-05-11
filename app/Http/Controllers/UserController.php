<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', "min:3", "max:255"],
            'email' => ['required', 'email', Rule::unique("users", 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in!');
    }

    public function show(User $user)
    {
        return view('users.show', [
            "user" => $user,
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logged out!');
    }

    //Show login from
    public function login()
    {
        return view('users.login');
    }

    // Authenticate user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Logged in!');
        }
    }
}
