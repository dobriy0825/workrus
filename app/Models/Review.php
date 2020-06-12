<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['from', 'whom', 'text', 'assessment'];

    public function job()
    {
        return $this->belongsTo(Job::class, 'from');
    }
}
