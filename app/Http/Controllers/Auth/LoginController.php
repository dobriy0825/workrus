<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use ThrottlesLogins;
    public static $firstLogin;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function username()
    {
        return self::$firstLogin;
    }

    public function checkFirstLogin(Request $request)
    {
        if($request->has('email')){
            self::$firstLogin = 'email';
        }else{
            self::$firstLogin = 'phone';
        }
    }

    public function showFormLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $this->checkFirstLogin($request);
        if ($this->hasTooManyLoginAttempts($request)){
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $data = $request->except('_method', '_token');

        $authenticate = Auth::attempt($data);
        if (!$authenticate){
           return back()->with('error' , 'Неправильный логин или пароль')->withInput();
        }
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        $user = Auth::user();
//        if ($user->status == 'wait'){
//            Auth::logout();
//            return back()->with('error', 'Ваш аккаунт не подтверждён ,проверьте свой e-mail');
//        }
        return redirect()->route('cabinet.settings');
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('main');
    }
}
