<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\pendaftaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            if (Hash::check($credentials['password'], $user->password)) {
                // return redirect()->route('/home')->with('success', 'Login berhasil');
                Auth::login($user);
                if ($user->role->admin()) {
                    return redirect()->route('dashboard.dashboard')->with('success', 'Login berhasil sebagai admin');
                } else {
                    return redirect()->route('home')->with('success', 'Login berhasil');
                }
            } else {
                return redirect()->route('login')->with('error', 'Password salah');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email tidak terdaftar');
        }
    }

}
