<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function showResetPassword($token)
    {
        if ($user = User::where('reset_password_token', $token)->first()){
            $data = ['email' => $user->email, 'password' => $user->password];
            $auth = Auth::login($user);
            return view('reset_password');
        }
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'new_password' => 'required',
            'new_password2' => 'required|same:new_password'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }
        $user = Auth::user();
        $user->update([
            'password' => bcrypt($request['new_password']),
            'reset_password_token' => null
        ]);
        return redirect()->route('cabinet.settings');
    }
}
