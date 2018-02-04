<?php

namespace App;

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
    
    
}
