<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AdminRegisterController extends Controller
{
    /**
     * Display the admin registration view.
     */
    public function create(): View
    {
        return view('auth.register-admin');
    }

    /**
     * Handle an incoming admin registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Set role as admin
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Debug: Check if user has admin role
        if ($user->role !== 'admin') {
            // This will help identify if there's an issue with role assignment
            dd('User role is not admin. Current role: ' . $user->role);
        }

        return redirect()->route('admin.dashboard')->with('status', 'Akun admin berhasil dibuat!');
    }
}