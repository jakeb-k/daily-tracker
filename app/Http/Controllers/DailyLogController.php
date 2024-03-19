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
        return view('dailylog.create'); 
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

        $validatedData = $request->validate([
            'hours_worked' => 'required|numeric|gt:0',
            'quality' => 'required|integer',
            'note' => 'required|max:250'
        ]);

        $dailyLog = new DailyLog(); 
        $dailyLog->hours_worked = $validatedData['hours_worked']; 
        $dailyLog->quality = $validatedData['quality']; 
        $dailyLog->note = $validatedData['note']; 
        $dailyLog->user_id = Auth::user()->id; 
      
        $dailyLog->save(); 


        $goals = Auth::user()->goals; 

        foreach($goals as $g) {
            $validateDlg =  $request->validate([
                'amount'.$g->id => 'required|numeric|gte:0'
            ]); 
            $dlg = new DailyLogGoal();
            $dlg->user_id = Auth::user()->id; 
            $dlg->goal_id = $g->id; 
            $dlg->amount = $validateDlg['amount'.$g->id]; 
            $dlg->log_id = $dailyLog->id; 
            
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
        //
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
