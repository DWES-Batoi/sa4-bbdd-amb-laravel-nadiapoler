<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $existing = User::where('email', $googleUser->getEmail())->first();

        // Si ja existeix però NO és convidat, deneguem
        if ($existing && $existing->role !== User::ROLE_CONVIDAT) {
            abort(403, 'Només els usuaris convidats poden autenticar-se amb Google.');
        }

        // Si no existeix, el creem com a convidat
        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName() ?? 'Convidat',
                'role' => User::ROLE_CONVIDAT,
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => null, // no s’usa
            ]
        );

        Auth::login($user);

        return redirect('/'); // o /home
    }
}