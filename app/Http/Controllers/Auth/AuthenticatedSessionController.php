<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {

        $email = $request->email;
        

        $request->authenticate();
        $check = User::where('email',$email)->first();
        if($check->status == 'deactive'){
            toast('Your Account Has been deactivated , For further Details Please Contact us!','info');
            return redirect()->back();
        }
        if($check->status == 'block'){
            toast('Your Account Has been Blocked ','warning');
            return redirect()->back();
        }
        $request->session()->regenerate();

        if(Auth::user()->user_type == 'superAdmin'){
            return redirect()->route('super.admin.dashboard');
        }
        if(Auth::user()->user_type == 'admin'){
            return redirect()->route('super.admin.dashboard');
        }
        if(Auth::user()->user_type == 'seller'){
            return redirect()->route('seller.dashboard');
        }
        // return redirect()->intended(RouteServiceProvider::HOME);
        return redirect()->intended('fallback');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
