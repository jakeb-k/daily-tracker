<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    function user(){
        return $this->belongsTo('App\Models\User');
    }
    protected $fillable=[
        'name',
        'description',
        'due_date',
        'progress'
    ]; 

    use HasFactory;
}
