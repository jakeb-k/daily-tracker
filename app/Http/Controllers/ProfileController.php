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
     
        
        $goalLogs = [];
        if($recentLogs) {
            return view('user')
                ->with('goals', $goals)
                ->with('logs', $recentLogs);
        } else {
            return view('user')->with('goals', $goals); 
        }
       

        // if($mostRecentLog != null) {
        //     $goalLogs = DailyLogGoal::where('log_id', $mostRecentLog->id)->get();
        //     return view('user')->with('goals', $goals)->with('log', $mostRecentLog)->with('goalLogs', $goalLogs); 
        // } else {
        //     return view('user')->with('goals', $goals); 

        // }

      
    }
}
