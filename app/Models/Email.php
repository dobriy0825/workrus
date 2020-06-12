<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['user_id', 'old_email', 'new_email', 'email_verified', 'email_verify_token'];
}
