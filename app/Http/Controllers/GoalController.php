<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal; 

use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    /**
     * Display a create form of the resource.
     */
    public function index()
    {
        return view('goals.create'); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'due_date' => 'required|date',
            'total' => 'required|numeric|gt:0',
            'description' => 'required|max:250'
        ]);
    
        $goal = new Goal();
        $goal->name = $validatedData['name'];
        $goal->due_date = $validatedData['due_date'];
        $goal->total = $validatedData['total'];
        $goal->description = $validatedData['description'];
        $goal->progress = 0; 
        $goal->user_id = Auth::user()->id; 

        
        $goal->save();

        return redirect('/user')->with('success_msg','Goal was added!'); 
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
        $goal = Goal::find($id); 

        $goal->delete();

        return redirect()->back()->with('success_msg', 'Goal was deleted!');
    }
}
