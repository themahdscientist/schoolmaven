<?php

namespace Database\Seeders;

use App\Models\StaffRole;
use Illuminate\Database\Seeder;

class StaffRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StaffRole::factory()->create(['name' => 'teaching_staff', 'description' => 'Teaching Staff']);
        StaffRole::factory()->create(['name' => 'non_teaching_staff', 'description' => 'Non Teaching Staff']);
    }
}
