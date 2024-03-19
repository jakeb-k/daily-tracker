<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DailyLog;
use Carbon\Carbon;

class DailyLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 13; $i >= 0; $i--) {
            DailyLog::factory()->create([
                'created_at' => Carbon::now()->subDays($i),
                'updated_at' => Carbon::now()->subDays($i),
            ]);
        }
    }
}
