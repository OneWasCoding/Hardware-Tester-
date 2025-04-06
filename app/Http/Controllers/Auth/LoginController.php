<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use function PHPSTORM_META\elementType;

class LoginController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Login Controller
    |----------------------------------------------------------------------
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
    // protected $redirectTo = '/home'; // You can remove this or leave it as is for default redirect

    /**
     * Redirect user after successful login based on role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // Check if the user is an admin
        if ($user->role === 'admin') {
            // Redirect to the admin dashboard (or your desired admin route)
            return redirect()->route('user.index');
        }elseif ($user->role === 'user') {
            // Redirect to the customer dashboard (or your desired customer route)
            return redirect()->route('home');
        }else{
            // Handle other roles or redirect to a default route
            return redirect()->route('login');     
           }     
    }

    /**
     * Handle the logout logic and redirect to the login page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/login'); // Redirect to the login page after logout
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


}
