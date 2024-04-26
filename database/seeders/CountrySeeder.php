<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = [
            ['name' => 'Nigeria', 'iso2' => 'NG'],
            ['name' => 'Afghanistan', 'iso2' => 'AF'],
            ['name' => 'Albania', 'iso2' => 'AL'],
            ['name' => 'Algeria', 'iso2' => 'DZ'],
            ['name' => 'Andorra', 'iso2' => 'AD'],
            ['name' => 'Angola', 'iso2' => 'AO'],
            ['name' => 'Antigua and Barbuda', 'iso2' => 'AG'],
            ['name' => 'Argentina', 'iso2' => 'AR'],
            ['name' => 'Armenia', 'iso2' => 'AM'],
            ['name' => 'Australia', 'iso2' => 'AU'],
            ['name' => 'Austria', 'iso2' => 'AT'],
            ['name' => 'Azerbaijan', 'iso2' => 'AZ'],
            ['name' => 'Bahamas', 'iso2' => 'BS'],
            ['name' => 'Bahrain', 'iso2' => 'BH'],
            ['name' => 'Bangladesh', 'iso2' => 'BD'],
            ['name' => 'Barbados', 'iso2' => 'BB'],
            ['name' => 'Belarus', 'iso2' => 'BY'],
            ['name' => 'Belgium', 'iso2' => 'BE'],
            ['name' => 'Belize', 'iso2' => 'BZ'],
            ['name' => 'Benin', 'iso2' => 'BJ'],
            ['name' => 'Bhutan', 'iso2' => 'BT'],
            ['name' => 'Bolivia', 'iso2' => 'BO'],
            ['name' => 'Bosnia and Herzegovina', 'iso2' => 'BA'],
            ['name' => 'Botswana', 'iso2' => 'BW'],
            ['name' => 'Brazil', 'iso2' => 'BR'],
            ['name' => 'Brunei', 'iso2' => 'BN'],
            ['name' => 'Bulgaria', 'iso2' => 'BG'],
            ['name' => 'Burkina Faso', 'iso2' => 'BF'],
            ['name' => 'Burundi', 'iso2' => 'BI'],
            ['name' => 'Cabo Verde', 'iso2' => 'CV'],
            ['name' => 'Cambodia', 'iso2' => 'KH'],
            ['name' => 'Cameroon', 'iso2' => 'CM'],
            ['name' => 'Canada', 'iso2' => 'CA'],
            ['name' => 'Central African Republic', 'iso2' => 'CF'],
            ['name' => 'Chad', 'iso2' => 'TD'],
            ['name' => 'Chile', 'iso2' => 'CL'],
            ['name' => 'China', 'iso2' => 'CN'],
            ['name' => 'Colombia', 'iso2' => 'CO'],
            ['name' => 'Comoros', 'iso2' => 'KM'],
        ];

        foreach ($countries as $country) {
            Country::factory()->create($country);
        }
    }
}
