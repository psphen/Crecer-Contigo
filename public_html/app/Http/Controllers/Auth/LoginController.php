<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        if ($user->isAdmin()) {
            $this->redirectTo = '/dashboard'; // Redirigir al dashboard si el usuario tiene el rol de administrador
        }
        elseif ($user->isVendor()){
            $this->redirectTo = '/profile/'.$user->slug.'/'.$user->id;
        }
        else {
            $this->redirectTo = $request->input('previous_url', RouteServiceProvider::HOME);
        }

        return redirect()->intended($this->redirectPath());
    }

}
