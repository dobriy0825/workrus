<?php


namespace App\Http\Controllers\Cabinet;


use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function editInput(Request $request)
    {
        //dd($request->all());
        $input = $request->except('_token','_method');
        //dd($input);
        $id = Auth::user()->id;
        $user = User::find($id);
        //dd($user);
        $user->update($input);
        return redirect()->back();
    }


}
