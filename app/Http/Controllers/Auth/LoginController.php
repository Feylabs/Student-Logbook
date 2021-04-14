<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return '/admin';
        }
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->intended('/admin');
        } else {
            return redirect('login/admin')->withErrors([
                'error' => 'Username Atau Password Salah'
            ]);
        }
        return back()->withInput($request->only('nisn', 'remember'));
    }




    public function santriLogin(Request $request)
    {
        $this->validate($request, [
            'nis'   => 'required',
            'password' => 'required|min:6'
        ]);


        // If contain email, this is Ustadz Account
        if (strpos($request->nis, '@') !== false) {
            if (Auth::guard('guru')->attempt(
                [
                    'email' => $request->nis,
                    'password' => $request->password
                ],
                $request->get('remember')
            )) {
                return redirect()->intended('/guru')->with(['success' => "Login Berhasil"]);
            } else {
                return redirect('login/')->withErrors([
                    'error' => 'Username Atau Password Salah'
                ]);
            }
        }

        if (Auth::guard('santri')->attempt(
            [
                'nis' => $request->nis,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->intended('/santri')->with(['success' => "Login Berhasil"]);
        } else {
            return redirect('login/santri')->withErrors([
                'error' => 'Username Atau Password Salah'
            ]);
        }
        return back()->withInput($request->only('nis', 'remember'));
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $this->guard()->logout();
        Auth::guard('guru')->logout();
        Auth::guard('santri')->logout();
        Auth::guard('admin')->logout();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
