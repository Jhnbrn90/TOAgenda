<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    
    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = [];

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
        $endDate = Carbon::parse($date)->addDays(7);
        $startDate = Carbon::parse($date);

        return $query->whereDate('timestamp', '<=', $endDate)->whereDate('timestamp', '>=', $startDate);
    }
    
    
}
