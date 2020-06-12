<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'phone' => $request['phone'],
            'password' => bcrypt($request['password']),
            'status' => User::STATUS_WAIT
        ]);
        $id = $user->id;
        $request->session()->put('user_id', $id);
    }
}
