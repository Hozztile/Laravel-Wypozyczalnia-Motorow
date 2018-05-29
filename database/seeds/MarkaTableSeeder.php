<?php

use Illuminate\Database\Seeder;
use App\Marka;

class MarkaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marka::create([
        	'nazwa' => 'Honda'
        ]);

        Marka::create([
        	'nazwa' => 'BMW'
        ]);

        Marka::create([
        	'nazwa' => 'Yamaha'
        ]);

        Marka::create([
        	'nazwa' => 'Suzuki'
        ]);

        Marka::create([
        	'nazwa' => 'Harley-Davidson'
        ]);
    }
}
