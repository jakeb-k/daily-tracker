<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\Goal;
use App\Models\DailyLog;
use App\Models\DailyLogGoal;

use Carbon\Carbon;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    /**
     * Display the user's goals and recent logs.
     */
    public function show(){
        $goals = Auth::user()->goals;

        $recentLogs = Auth::user()->dailyLogs()->latest()->take(3)->get();
     
        $logs = DailyLog::all(); 
                // Assuming $entities is your collection of entity instances.
        $uniqueDates = $logs->sortBy('created_at')->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->startOfDay()->toDateString();
        })->unique();
        
        
        // Initialize the streak and the previous date.
        $streak = 0;
        $previousDate = null;

        // Today's date for comparison, making sure we include today in the streak if it exists.
        $today = Carbon::today()->toDateString();

        // Loop through unique dates
        foreach ($uniqueDates as $dateString) {

            $currentDate = Carbon::parse($dateString);
          
            if ($previousDate) {
                $difference = $currentDate->diffInDays($previousDate);
                
                if ($difference == -1) {
                    $streak++;
                } elseif ($difference < -1) {
                    // Reset streak if there's a gap of more than one day
                    $streak = 1;
                }
            } else {
                // Start the streak or set it to 1 if today has an entry
                $streak = ($currentDate->toDateString() === $today) ? 1 : 0;
            }
            $previousDate = $currentDate;
        }
        
        $goalLogs = [];
        if($recentLogs) {
            return view('user')
                ->with('goals', $goals)
                ->with('logs', $recentLogs)
                ->with('streak', $streak);
        } else {
            return view('user')->with('goals', $goals)->with('streak', $streak); 
        }
       

        // if($mostRecentLog != null) {
        //     $goalLogs = DailyLogGoal::where('log_id', $mostRecentLog->id)->get();
        //     return view('user')->with('goals', $goals)->with('log', $mostRecentLog)->with('goalLogs', $goalLogs); 
        // } else {
        //     return view('user')->with('goals', $goals); 

        // }

      
    }
}
