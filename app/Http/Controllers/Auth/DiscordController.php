<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    public function __construct(User $user)
    {
        $this->player = $user;
    }

    /**
     * Redirect the user to the Discord authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('discord')->redirect();
    }

    /**
     * Obtain the user information from Discord.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {

        if (request('error') == 'access_denied') {
            return \redirect('/');
        }

        $user = Socialite::driver('discord')->user();

        $authUser = $this->player->findOrCreateUser($user);

        Auth::login($authUser, true);

        if (!$authUser->character) {
            return redirect()->action(
                [CharacterController::class, 'create']
            );
        }

        return \redirect('/');
    }
}
