<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'title' => 'Daily Standup',
            'description' => 'Morning update meeting',
            'start' => now(),
            'end' => now()->addHour(),
            'type' => 'task',
        ]);

        Event::create([
            'title' => 'Project Launch Event',
            'description' => 'Public launch of new product',
            'start' => now()->addDays(5),
            'end' => now()->addDays(5)->addHours(3),
            'type' => 'event',
        ]);
    }
}

