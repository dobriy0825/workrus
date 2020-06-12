<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PhoneVerifyRequest;
use App\Models\Phone;
use App\Models\User;
use App\UseCases\Auth\RegisterService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ReCaptcha\ReCaptcha;


class RegisterController extends Controller
{
    public const SITE_KEY = '6LcdAsgUAAAAANVIvr8qi-Hh0XruArf0UY9FDbDQ';
    protected const SECRET_KEY = '6LcdAsgUAAAAAM0TkTdk3_K17tdUA-KMJYmzvUG1';
    protected $service;

    public function __construct(RegisterService $service)
    {
        $this->service = $service;
        $this->middleware('guest');
    }



    public function showFormRegister()
    {
        $sk = self::SITE_KEY;
        return view('auth.register', compact('sk'));
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'password2' => 'required|same:password'
        ]);
        $result = [];
        if ($validator->fails()) {
            $result['valid'] = $validator->errors()->first();
        } else {
            $user = User::create([
                'password' => bcrypt($request['password']),
                'status' => User::STATUS_WAIT
            ]);
            $phone = Phone::create([
                'user_id' => $user->id,
                'new_phone' => $request->phone,
                'phone_verified' => false,
                'phone_verify_code' => '55555',
                'phone_verify_code_expire' => Carbon::now()->copy()->addSeconds(40)

            ]);

            // Отправка смс на номер телефона
            $id = $phone->id;
            session()->put('phone_id', $id);
            $date = $phone->phone_verify_code_expire;
            $result['time'] = Carbon::now()->diffInSeconds($date, false);
        }
        return $result;
    }



    public function deRegistration()
    {
        $id = session()->get('phone_id');
        $phone = Phone::find($id);
        $user_id = $phone->user_id;
        $user = User::find($user_id);
        $phone->delete();
        $user->delete();
        session()->forget('phone_id');
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
            $id = session()->get('phone_id');
            $phone = Phone::find($id);
            $code = $request->code;
            if ($code != $phone->phone_verify_code){
                $result['errors'] = 'Введён неправильный код';
            }
            elseif(!$phone->phone_verify_code_expire->gt(Carbon::now())){
                $result['errors'] = 'Время кода истекло!';
            }else{
                $phone->update([
                    'phone_verified' => true,
                    'phone_verify_code' => null,
                    'phone_verify_code_expire' => null
                ]);
                if ($phone->phone_verified){
                    $user = User::find($phone->user_id);
                    $user->update([
                        'phone' => $phone->new_phone
                    ]);
                }
                session()->forget('phone_id');
                $result['view'] = view('auth.result_register');
            }
        }
        return $result;
    }

    public function resendVerifyCode(){
        $id = session()->get('phone_id');
        $phone = Phone::find($id);
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
}
