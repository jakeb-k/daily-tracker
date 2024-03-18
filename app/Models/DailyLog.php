<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function dailyLogGoals() {
        return $this->hasMany('App\Models\DailyLogGoals');
    }
    protected $fillable=[
        'date',
        'hours',
        'quality',
        'score',
        'goal_id'
    ]; 
    use HasFactory;
}
