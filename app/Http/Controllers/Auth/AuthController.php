<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        if ($authUser->password == "") {
            return redirect(route('manageAccount-page'))->with('modal_open', true);
        }
        return redirect('/');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        // $authUser = User::where('provider_id', $user->id)->first();
        $authUser = User::where('email', $user->email)->first();
        if ($authUser) {
            return $authUser;
        } else {
            $data = User::create([
                'name'     => $user->name,
                'email'    => !empty($user->email) ? $user->email : '',
                'api_key' => "1"
            ]);
            $data->api_key = $user->id . "" . preg_replace('/[\W]/', '', md5($user->id));
            $data->save();
            return $data;
        }
    }

    public function logoutCustom()
    {
        Auth::logout();
        return redirect(route('landing-page'));
    }
}
