<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Models\User;
use App\Notifications\DailyEmailNotification;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('send:daily-emails', function () {
    $users = User::all(); // or a specific condition to select users
    foreach ($users as $user) {
        $user->notify(new DailyEmailNotification());
    
    }
})->describe('Send daily emails to users');

// Then, schedule it in the same file
Artisan::command('schedule:run', function () {
    $this->call('send:daily-emails');
})->everyMinute(); 
