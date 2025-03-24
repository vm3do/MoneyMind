<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'salary' => 'required|integer|min:0',
            'salary_date' => 'required|integer|min:1|max:31'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'salary' => $request->salary,
            'balance' => $request->salary,
            'salary_date' => $request->salary_date
        ]);

        event(new Registered($user));

        Auth::login($user);
        Alert::create(['user_id' => Auth::user()->id, 'percentage' => 50]);

        if(auth()->user()->role == 'admin'){
            return redirect(route('dashboard', absolute: false));
        } else {
            return redirect(route('expenses.index', absolute: false));
        }
        
    }
}
