<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['new_phone', 'phone_verified', 'phone_verify_code', 'phone_verify_code_expire', 'old_phone', 'user_id'];
    protected $casts = [
        'phone_verify_code_expire' => 'datetime',
        'phone_verified' => 'boolean'
    ];
}
