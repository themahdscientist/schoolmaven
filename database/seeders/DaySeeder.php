<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            ['name' => 'sunday'],
            ['name' => 'monday'],
            ['name' => 'tuesday'],
            ['name' => 'wednesday'],
            ['name' => 'thursday'],
            ['name' => 'friday'],
            ['name' => 'saturday'],
        ];

        foreach ($days as $day) {
            Day::factory()->create($day);
        }
    }
}
