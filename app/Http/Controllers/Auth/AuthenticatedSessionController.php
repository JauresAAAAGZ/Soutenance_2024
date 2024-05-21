<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login-etu');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
       /* $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);*/
        
        // Use the login function for authentication and redirection
        return $this->login($request);
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

    protected function login(Request $request){

        $credentials=$request->validate([

            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials)){

            $user_role=Auth::user()->role_id;

            switch($user_role){

                case 1:
                    return redirect()->route('dashetu');
                    break;
                case 2:
                    return redirect()->route('dashens');
                    break;
                case 3:
                    return redirect()->route('dashadmin');
                    break;
                case 4: 
                    return redirect()->route('dashExamen');
                    break;
                default:
                    Auth::logout();
                    redirect()->route('welcome')->with('error','no rule assigned');

            }

        }else{

            return redirect()->route('welcome')->with('error','');
        }

    }
}
