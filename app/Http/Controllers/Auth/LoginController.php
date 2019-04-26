<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Socialite;

use App\User;

use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $social_user = Socialite::driver($provider)->user();

        // dd($social_user);

        // // OAuth Two Providers
        // $token = $user->token;
        // $refreshToken = $user->refreshToken; // not always provided
        // $expiresIn = $user->expiresIn;

        // // OAuth One Providers
        // $token = $user->token;
        // $tokenSecret = $user->tokenSecret;



        // All Providers
        // $user->getId();
        // $user->getNickname();
        // $user->getName();
        // $user->getEmail();
        // $user->getAvatar();

        // $user->token;


        $authUser = $this->findOrCreateUser($social_user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);


    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::updateOrCreate(
        [
            'provider' => $provider,
            'provider_id' => $user->id
        ],
        [
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar
        ]
        );

        return $authUser;
        
    }
}
