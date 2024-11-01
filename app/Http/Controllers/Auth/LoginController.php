<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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


    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::find(Auth::id());
            // if ($user->hasRole('Parent')  && $request->email != 'testparent@mailinator.com') {
            //     Auth::logout();
            //     return redirect()->route('login')
            //         ->with('error', 'As of now, we would like to inform you that the platform is currently undergoing its final stages of development and testing. We appreciate your enthusiasm and patience during this process.');
            //     // if ($user->parent && $user->parent->status == 0) {
            //     //     Auth::logout();
            //     //     return redirect()->route('login')
            //     //         ->with('error', 'Your parent account is not active. please contact to admin for further details');
            //     // }
            // }

            // if ($user->hasRole('Franchise') && $request->email != 'testprovider@mailinator.com') {
            //     Auth::logout();
            //     return redirect()->route('login')
            //         ->with('error', 'As of now, we would like to inform you that the platform is currently undergoing its final stages of development and testing. We appreciate your enthusiasm and patience during this process.');
            //     // if ($user->provider && $user->provider->status == 0) {
            //     //     Auth::logout();
            //     //     return redirect()->route('login')
            //     //         ->with('error', 'Your provider account is not active. please contact to admin for further details');
            //     // }
            // }
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    protected function authenticated(Request $request, $user)
    {
        // Check the user's role and redirect accordingly
        if ($request->user()->hasRole('Admin')) {
            return redirect()->route('admin.home');
        } elseif ($request->user()->hasRole('Franchise')) {
            return redirect()->route('provider.home');
        } else {
            return redirect()->route('parent.home');
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }
}
