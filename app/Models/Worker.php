<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Worker extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'age',
        'sex',
        'city',
        'about_me',
        'user_id',
        'tasks_completed',
        'rating',
        'draft'
    ];

    public function formatDate(Carbon $date)
    {
        return Carbon::parse($date)->format('d.m.Y');
    }

    public function str($str)
    {
        return Str::limit($str, 70);
    }

    public function addView(Worker $worker)
    {
        $worker->update(['views' => $worker->views++]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,
            'category_worker',
            'worker_id',
            'category_id');
    }

    public function subCategories()
    {
        return $this->belongsToMany(SubCategory::class,
            'sub_category_worker',
            'worker_id',
            'sub_category_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'whom')->with('job');
    }

    public function completedJobs()
    {
        return $this->belongsToMany(Job::class, 'completed_tasks', 'job_id', 'worker_id');
    }

    public function proposedJobs()
    {
        return $this->belongsToMany(Job::class, 'proposed_tasks', 'worker_id', 'job_id');
    }

    public function hiredJobs(){
        return $this->belongsToMany(Job::class, 'hired_jobs', 'worker_id', 'job_id');
    }
}
