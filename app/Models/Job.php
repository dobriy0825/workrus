<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Job extends Model
{
    protected $fillable = [
        'title',
        'category',
        'sub_category',
        'address',
        'need_people',
        'start',
        'finish',
        'price',
        'description',
        'views',
        'draft',
        'status'
    ];

    public const STATUS_OPEN = 'Открыто';
    public const STATUS_IN_GEAR = 'В работе';
    public const STATUS_PERFORMED = 'Выполнено';
    public const STATUS_NOT_PERFORMED = 'Не выполнено';

    public static function dateFromValue($date)
    {
        $d = Carbon::parse($date);
        $day = $d->day;
        $month = $d->month;
        return self::addZero($day) . '.' . self::addZero($month) . '.' . $d->year;
    }

    public static function timeFromValue($date)
    {
        $date = Carbon::parse($date);
        $hour = $date->hour;
        $minute = $date->minute;
        return self::addZero($hour) . ':' . self::addZero($minute);
    }

    public static function addZero($value)
    {
        if (strlen($value) < 2){
            $result = '0' . $value;
            return $result;
        }else{
            return $value;
        }
    }

    public function str($str)
    {
        return Str::limit($str, 70);
    }

    public function addView()
    {
        $this->update(['views' => $this->views + 1]);
    }

    public function isProposedWorker($worker, $proposedWorkers)
    {
        return $proposedWorkers->contains($worker);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offerWorkers()
    {
        return $this->belongsToMany(Worker::class, 'proposed_workers', 'job_id', 'worker_id');
    }

    public function hiredWorkers()
    {
        return $this->belongsToMany(Worker::class, 'hired_workers', 'job_id', 'worker_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'from');
    }
    // Scope
    public function scopeStatusOpen(Builder $query)
    {
        return $query->where('status', self::STATUS_OPEN);

    }
}
