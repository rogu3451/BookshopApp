<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\{User,Photo,Basket}; 

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

    use AuthenticatesUsers
    {
        logout as performLogout;
    }
    
    public function logout(Request $request)
    {
        //akcje po wylogowaniu
        $user_id = $request->user()->id;
        Basket::whereNotNull('id')->where('user_id',$user_id)->delete();  // wyczysc koszyk uzytkownika o id
        $this->performLogout($request);
        return redirect()->route('home');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

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
    public function redirectToProvider(Request $request)
    {
        $provider = $request->input('login');
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($id)
    {
        
        //dd($id);
        $socialiteUser = Socialite::driver($id)->user();
		
		 //dd($socialiteUser);  // do testow aby pokazac zwrocone rekordy
		 $authUser = User::where('email', $socialiteUser->email)->first();

		if ($authUser){ // Sprawdzenie czy podany uzytkownik githuba nie został juz dodany do bazy
			
			Auth::login($authUser, true);
			return redirect($this->redirectTo);
		}
		
		// dodanie uzytkownika z githuba do bazy danych
		$user = User::create([
			'email' => $socialiteUser->getEmail(),
			'name' => $socialiteUser->getName(),
			'provider_id' => $socialiteUser->getId(),
		]);
        
        $photo = new Photo;
        $photo->path = $socialiteUser->getAvatar();
        $user->photos()->save($photo);
		
		// logowanie uzytkownika
		Auth::login($user, true);
        
		return redirect($this->redirectTo);
    }
}
