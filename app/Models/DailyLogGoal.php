<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLogGoal extends Model
{
    function goal(){
        return $this->belongsTo('App\Models\Goal');
    }
    function daily_log(){
        return $this->belongsTo('App\Models\DailyLog');
    }
    protected $fillable=[
        'goal_id',
        'log_id',
        'amount',
    ]; 
    use HasFactory;
}
