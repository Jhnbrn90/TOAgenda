<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $with = ['creator'];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($appointment) {
            $appointment->update(['timestamp' => Carbon::parse($appointment->date)]);
        });
    }

    public function path()
    {
        return "appointments/{$this->id}";
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeWeek($query, $date)
    {
        // check if the $date is a saturday or sunday
        if (Carbon::parse($date)->isWeekend()) {
            $endDate = Carbon::parse($date)->addWeek()->endOfWeek()->endOfDay();
            $startDate = Carbon::parse($date)->addWeek()->startOfWeek()->startOfDay();
        } else {
            $endDate = Carbon::parse($date)->endOfWeek()->endOfDay();
            $startDate = Carbon::parse($date)->startOfWeek()->startOfDay();
        }

        return $query->whereDate('timestamp', '<=', $endDate)->whereDate('timestamp', '>=', $startDate);
    }
}
