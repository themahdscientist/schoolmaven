<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nigeria = 1;

        $states = [
            ['country_id' => $nigeria, 'name' => 'Abia', 'iso2' => 'NG-AB', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Adamawa', 'iso2' => 'NG-AD', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Akwa Ibom', 'iso2' => 'NG-AK', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Anambra', 'iso2' => 'NG-AN', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Bauchi', 'iso2' => 'NG-BA', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Bayelsa', 'iso2' => 'NG-BY', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Benue', 'iso2' => 'NG-BE', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Borno', 'iso2' => 'NG-BO', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Cross River', 'iso2' => 'NG-CR', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Delta', 'iso2' => 'NG-DE', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Ebonyi', 'iso2' => 'NG-EB', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Edo', 'iso2' => 'NG-ED', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Ekiti', 'iso2' => 'NG-EK', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Enugu', 'iso2' => 'NG-EN', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Gombe', 'iso2' => 'NG-GO', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Imo', 'iso2' => 'NG-IM', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Jigawa', 'iso2' => 'NG-JI', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Kaduna', 'iso2' => 'NG-KD', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Kano', 'iso2' => 'NG-KN', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Katsina', 'iso2' => 'NG-KT', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Kebbi', 'iso2' => 'NG-KE', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Kogi', 'iso2' => 'NG-KO', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Kwara', 'iso2' => 'NG-KW', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Lagos', 'iso2' => 'NG-LA', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Nasarawa', 'iso2' => 'NG-NA', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Niger', 'iso2' => 'NG-NI', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Ogun', 'iso2' => 'NG-OG', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Ondo', 'iso2' => 'NG-ON', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Osun', 'iso2' => 'NG-OS', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Oyo', 'iso2' => 'NG-OY', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Plateau', 'iso2' => 'NG-PL', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Rivers', 'iso2' => 'NG-RI', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Sokoto', 'iso2' => 'NG-SO', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Taraba', 'iso2' => 'NG-TA', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Yobe', 'iso2' => 'NG-YO', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Zamfara', 'iso2' => 'NG-ZA', 'capital' => false],
            ['country_id' => $nigeria, 'name' => 'Federal Capital Territory', 'iso2' => 'NG-FC', 'capital' => true],
        ];

        foreach ($states as $state) {
            State::factory()->create($state);
        }
    }
}
