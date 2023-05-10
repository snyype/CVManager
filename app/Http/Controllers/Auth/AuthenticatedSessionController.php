<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;



class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

   

    public function redirectToGoogle()
    {
        
            return Socialite::driver('google')->redirect();
          
            // Redirect to the login page with an error message
           
    }
    


public function handleGoogleCallback()
{
    try {
        $user = Socialite::driver('google')->user();
       
       
    } catch (\Exception $e) {
        return redirect('/login');
    }

    $existingUser = User::where('email', $user->getEmail())->first();

    if ($existingUser) {
        Auth::login($existingUser, true);
    } else {
        $newUser = new User;
        $newUser->name = $user->getName();
        $newUser->avatar = $user->getAvatar();
        $newUser->email = $user->getEmail();
        $newUser->password = Hash::make(Str::random(24));
        $newUser->save();

        Auth::login($newUser, true);
    }

    return redirect()->intended('/dashboard');
}



}
