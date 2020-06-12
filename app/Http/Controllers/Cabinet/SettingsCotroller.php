<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\Models\Phone;
use App\Models\Email;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingsCotroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showSettings()
    {
        $user = Auth::user();
        return view('cabinet.settings.setting', compact('user'));
    }



    public function editPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users,phone'
        ]);
        $result = [];
        if ($validator->fails()){
            $result['errors'] = $validator->errors()->first();
        }else{
            $phone = Phone::create([
                'user_id' => Auth::id(),
                'old_phone' => Auth::user()->phone,
                'new_phone' => $request->phone,
                'phone_verified' => false,
                'phone_verify_code' => '55555',
                'phone_verify_code_expire' => Carbon::now()->copy()->addSeconds(40)
            ]);
            $date = $phone->phone_verify_code_expire;
            $result['time'] = Carbon::now()->diffInSeconds($date, false);
        }
        return $result;
    }


    public function verifyPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:5'
        ]);
        $result = [];
        if ($validator->fails()){
            $result['valid'] = $validator->errors()->first();
        }else{
            $code = $request->code;
            $phone = Phone::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->first();

            if(!$phone->phone_verify_code_expire->gt(Carbon::now())){
                $result['errors'] = 'Время кода истекло!';
            }
            elseif($code != $phone->phone_verify_code){
                $result['errors'] = 'Введён неправильный код';
            }else {
                $phone->update([
                    'phone_verified' => true,
                    'phone_verify_code' => null,
                    'phone_verify_code_expire' => null
                ]);
                Auth::user()->update([
                    'phone' => $phone->new_phone
                ]);
                $result['phone'] = Auth::user()->phone;
            }
        }
        return $result;
    }



    public function resendVerifyCode()
    {
        $phone = Phone::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->first();
        $errors = [];
        if($phone->phone_verify_code_expire->gt(Carbon::now())){
            $errors['errors'] = 'Время кода ещё не истекло!';
        }else{
            $phone->update([
                'phone_verify_code' => '00000',
                'phone_verify_code_expire' => Carbon::now()->copy()->addSeconds(20)
            ]);
            $date = $phone->phone_verify_code_expire;
            $errors['time'] = Carbon::now()->diffInSeconds($date, false);
        }
        return $errors;

    }



    public function doNotChange()
    {
        $phone = Phone::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $phone->delete();
    }



    public function fillWithData(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'sex' => 'required',
            'year' => 'required',
            'month' => 'required',
            'day' => 'required',
        ]);
//        if ($validator->fails()){
//            return back()->withInput()->withErrors('errors');
//        }
        $result = Carbon::create($request->year, $request->month, $request->day);
        Auth::user()->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'sex' => $request->sex,
            'birth_day' => $result,
            'age' => (int)$result->diffInYears(Carbon::now())
        ]);
        return redirect()->route('cabinet.settings');
    }



    public function allAction(Request $request)
    {
        $res = $request->has([
            'name','surname','sex','year','month','day'
        ]);
        if ($res){
            return $this->fillWithData($request);
        }

        $c = $request->except('_method', '_token');
        if (count($c) == 1){
            return $this->editInput($request);
        }
    }


    public function addEmail(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|unique:users,email'
        ]);
        $result = [];
        if ($validator->fails()){
            $result['valid'] = $validator->errors()->first();
        }else{
            $email = Email::create([
                'new_email' => $request->email,
                'email_verify_token' => Str::uuid(),
                'user_id' => Auth::id()
            ]);
            //dd($email);
            Mail::to($email->new_email)->send(new VerifyMail($email));
            $result['id'] = $email->id;
        }
        return $result;
    }



    public function editEmail(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|unique:users,email'
        ]);
        $result = [];
        if ($validator->fails()){
            $result['valid'] = $validator->errors()->first();
        }else{
            $email = Email::create([
                'old_email' => Auth::user()->email,
                'new_email' => $request->email,
                'email_verify_token' => Str::uuid(),
                'user_id' => Auth::id()
            ]);
            //dd($email);
            Mail::to($email->new_email)->send(new VerifyMail($email));
            $result['id'] = $email->id;
        }
        return $result;
    }



    public function verifyEmail($token){
        $email = Email::where('email_verify_token', $token)->first();
        if ($token == $email->email_verify_token){
            $email->update([
                'email_verified' => true,
                'email_verify_token' => null
            ]);
            $user = User::find($email->user_id);
            $user->update([
                'email' => $email->new_email
            ]);
            $auth = Auth::attempt(['phone' => $user->phone, 'password' => $user->password]);
        }
        return redirect()->route('cabinet.settings');
    }



    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'required',
            'new_password2' => 'required|same:new_password'
        ]);
        $user = Auth::user();

        $result = [];
        if ($validator->fails()) {
            $result['errors'] = $validator->errors()->first();
        } elseif (!Hash::check($request->password, $user->password)) {
            $result['errors'] = 'Неправильный текущий пароль';
        } else {
            $user->update([
                'password' => bcrypt($request['new_password']),
                'reset_password_token' => null
            ]);
            //return redirect()->route('cabinet.settings');
        }
        return $result;
    }

    public function toggleCheck(Request $request)    {

        $key = array_key_first($request->all());
        //dd((boolean)$request->input($key));
        //dd($key);
        $user = Auth::user();
        //dd($user->hide_workers);
        $data = ['hide_workers','report_by_phone_w','report_by_email_w'];
//        for ($i = 0; $i < count($data); $i++){
//
//        }
        $user->update([
            $key => $request->input($key)
        ]);
        //return $user;
    }
}
