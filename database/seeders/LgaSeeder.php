<?php

namespace Database\Seeders;

use App\Models\Lga;
use Illuminate\Database\Seeder;

class LgaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming Abia state has an id of 1 in the states table
        $abia = 1;

        Lga::factory()->create(['name' => 'Aba North', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Aba South', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Arochukwu', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Bende', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ikwuano', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Isiala Ngwa North', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Isiala Ngwa South', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Isuikwuato', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Obi Ngwa', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ohafia', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Osisioma Ngwa', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ugwunagbo', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ukwa East', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ukwa West', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Umuahia North', 'state_id' => $abia, 'capital' => true]);  // Assuming Umuahia North is the capital LGA
        Lga::factory()->create(['name' => 'Umuahia South', 'state_id' => $abia, 'capital' => false]);
        Lga::factory()->create(['name' => 'Umunneochi', 'state_id' => $abia, 'capital' => false]);

        // Assuming Adamawa state has an id of 2 in the states table
        $adamawa = 2;

        Lga::factory()->create(['name' => 'Demsa', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Fufore', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ganye', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Girei', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Gombi', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Guyuk', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Hong', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Jada', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Lamurde', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Madagali', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Maiha', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Mayo-Belwa', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Michika', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Mubi North', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Mubi South', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Numan', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Shelleng', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Song', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Toungo', 'state_id' => $adamawa, 'capital' => false]);
        Lga::factory()->create(['name' => 'Yola North', 'state_id' => $adamawa, 'capital' => true]);  // Assuming Yola North is the capital LGA
        Lga::factory()->create(['name' => 'Yola South', 'state_id' => $adamawa, 'capital' => false]);

        // Assuming Akwa Ibom state has an id of 3 in the states table
        $akwa_ibom = 3;

        Lga::factory()->create(['name' => 'Abak', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Eastern Obolo', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Eket', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Esit Eket', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Essien Udim', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Etim Ekpo', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Etinan', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ibeno', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ibesikpo Asutan', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ibiono Ibom', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ika', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ikono', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ikot Abasi', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ikot Ekpene', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ini', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Itu', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Mbo', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Mkpat Enin', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Nsit Atai', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Nsit Ibom', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Nsit Ubium', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Obot Akara', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Okobo', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Onna', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Oron', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Oruk Anam', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Udung Uko', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ukanafun', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Uruan', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Urue-Offong/Oruko', 'state_id' => $akwa_ibom, 'capital' => false]);
        Lga::factory()->create(['name' => 'Uyo', 'state_id' => $akwa_ibom, 'capital' => true]);  // Assuming Uyo is the capital LGA

        // Assuming Anambra state has an id of 4 in the states table
        $anambra = 4;

        Lga::factory()->create(['name' => 'Aguata', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Awka North', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Awka South', 'state_id' => $anambra, 'capital' => true]);  // Assuming Awka South is the capital LGA
        Lga::factory()->create(['name' => 'Anambra East', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Anambra West', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Anaocha', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ayamelum', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Dunukofia', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ekwusigo', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Idemili North', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Idemili South', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ihiala', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Njikoka', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Nnewi North', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Nnewi South', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Ogbaru', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Onitsha North', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Onitsha South', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Orumba North', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Orumba South', 'state_id' => $anambra, 'capital' => false]);
        Lga::factory()->create(['name' => 'Oyi', 'state_id' => $anambra, 'capital' => false]);
    }
}
