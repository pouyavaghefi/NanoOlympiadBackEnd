<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
//            'g-recaptcha-response' => 'required|captcha'
        ]);

        $credentials['uname'] = $credentials['email'];
        unset($credentials['email']);
        unset($credentials['g-recaptcha-response']);

        $user = User::where('super_user',1)->where('is_active',1)->where('uname',$credentials['uname'])->first();
        if($user) {
            if (password_verify($credentials['password'], $user->password)) {
                Auth::login($user);

                $user->last_login = date('Y-m-d H:i:s');
                $user->save();

                $request->session()->regenerate();

                return redirect()->intended('/');
            } else {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->withInput();
            }
        }else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput();
        }
    }
}
