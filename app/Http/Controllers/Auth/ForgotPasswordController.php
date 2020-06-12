<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotPassword()
    {
        return  view('forgot_password');
    }


    public function sendLinkResetPassword(Request $request)
    {
        $validator = Validator::make($request->only('email'), [
            'email' => 'required|string|email'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }
        $user = User::where('email', $request->email)->first();
        $user->update([
            'reset_password_token' => Str::uuid()
        ]);

        //dd($user->email);
        Mail::to($request->email)->send(new ResetPasswordMail($user));
        return 'Сообщение на Ваш элективный адрес отправлено!';
    }

}
