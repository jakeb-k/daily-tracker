<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User; 
use App\Models\Goal; 
use App\Models\DailyLog; 
use App\Models\DailyLogGoal; 


class DailyLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //order by most recent so they are the first to be displayed
        $logs = DailyLog::where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('dailylog.index')->with('logs',$logs); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $goals = Auth::user()->goals;  

        return view('dailylog.create')->with('goals', $goals); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dlgs = []; 
        //validate and sanitise the input
        $validatedData = $request->validate([
            'hours_worked' => 'required|numeric|gt:0',
            'quality' => 'required|integer',
            'note' => 'required|max:250'
        ]);

        //create the new daily log and assign the values
        $dailyLog = new DailyLog(); 
        $dailyLog->hours_worked = $validatedData['hours_worked']; 
        $dailyLog->quality = $validatedData['quality']; 
        $dailyLog->note = $validatedData['note']; 
        $dailyLog->user_id = Auth::user()->id; 
      
        $dailyLog->save(); 

        //get all the goals so the id can be assigned as foreign key
        $goals = Auth::user()->goals; 

        //loop through goals, as these are the goal progress values to be stored as bridging entities
        foreach($goals as $g) {
            $validateDlg =  $request->validate([
                'amount'.$g->id => 'required|numeric|gte:0'
            ]); 
            //once validated the data create a new daily log goal
            $dlg = new DailyLogGoal();
            $dlg->name = $g->name; 
            $dlg->user_id = Auth::user()->id; 
            $dlg->goal_id = $g->id; 
            //the goals are looped through in the form and given the name amount{{$g->id}}
            //so this is a way to access them
            $dlg->amount = $validateDlg['amount'.$g->id]; 
            $dlg->log_id = $dailyLog->id; 
            
            //progress is saved as floatval, as integer may cause improper calculations
            $g->progress += floatval($validateDlg['amount'.$g->id]); 
            
            $g->save(); 
            $dlg->save(); 
        }

        return redirect('/user')->with('success_msg', 'You have done your daily log!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $log = DailyLog::find($id); 

        //Model function
        $goalProgress = $log->dailyLogGoals; 
        

        return view('dailylog.show')->with('log',$log)->with('goalProgress',$goalProgress); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
