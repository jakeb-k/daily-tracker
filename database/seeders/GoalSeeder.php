<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('goals')->insert([
            'name' => "Fornightly Gratefulness Tracker",
            'due_date' => Carbon::now()->addWeeks(2), 
            'total' => 14,
            'description'=>'I want to be more grateful over the next two weeks',
            'user_id' => 1,
            'progress' => 0
        ]);
        DB::table('goals')->insert([
            'name' => "Fornightly Anger Tracker",
            'due_date' => Carbon::now()->addWeeks(2), 
            'total' => 7,
            'description'=>'I want to be less angry over the next two weeks',
            'user_id' => 1,
            'progress' => 0
        ]);
        DB::table('goals')->insert([
            'name' => "Cloud Computing Hours",
            'due_date' => Carbon::now()->addWeeks(2), 
            'total' => 40,
            'description'=>'I want to do 40 hours of cloud computing work over the next two weeks',
            'user_id' => 1,
            'progress' => 0
        ]);
    }
}
