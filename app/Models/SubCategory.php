<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubCategory extends Model
{
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function worker()
    {

    }


    public function yyy($str)
    {
        return Str::slug($str);
    }
}
