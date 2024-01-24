<?php

namespace Database\Seeders;

use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Specify the start and end times for your time slots
        $startTime = Carbon::parse('09:00 AM');
        $endTime = Carbon::parse('05:00 PM');

        // Time interval for each slot (60 minutes in this example)
        $interval = 60;

        // Create slots and insert into the database
        $currentTime = clone $startTime;

        while ($currentTime <= $endTime) {
            Slot::insert([
                'name' => $currentTime->format('h:i A'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $currentTime->addMinutes($interval);
        }
    }
}
