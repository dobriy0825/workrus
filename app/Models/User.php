<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class User extends Authenticatable
{

    public const STATUS_WAIT = 'wait';
    public const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'name',
        'surname',
        'sex',
        'birth_day',
        'age',
        'phone',
        'email',
        'password',
        'status',
        'reset_password_token',
        'hide_workers',
        'report_by_phone_w',
        'report_by_email_w',
        'hide_jobs',
        'report_by_phone_j',
        'report_by_email_j'
        ];


    public function requestPhoneVerifyCode()
    {
        if ($this->phone_verify_code && $this->phone_verify_code_expire->gt(Carbon::now())){
            throw new \DomainException('Время кода еще не истекло!');
        }
        $this->update([
            'phone_verify_code' => '55555',
            //(string)random_int(10000, 99999),
            'phone_verify_code_expire' => Carbon::now()->copy()->addSeconds(20)
        ]);
        $date = $this->phone_verify_code_expire;
        return Carbon::now()->diffInSeconds($date, false);
    }

    public function isWorker()
    {
        return $this->worker ? true : false;
    }

    public function isOnline()
    {
        return \Cache::has('user-is-online-' . $this->id);
    }

    public function authenticatedUserJob($job, $jobs)
    {
        return $jobs->contains($job);
    }

    public function f($string)
    {
        return $this->$string;
    }





    public function worker()
    {
        return $this->hasOne(Worker::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function myReviews()
    {
        return $this->hasMany(Review::class, 'from');
    }


}
