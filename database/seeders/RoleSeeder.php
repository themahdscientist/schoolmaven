<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create(['name' => 'admin', 'description' => 'Administrator']);
        Role::factory()->create(['name' => 'student', 'description' => 'Student']);
        Role::factory()->create(['name' => 'staff', 'description' => 'Staff']);
        Role::factory()->create(['name' => 'guardian', 'description' => 'Guardian']);
    }
}
