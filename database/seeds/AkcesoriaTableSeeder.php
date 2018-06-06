<?php

use Illuminate\Database\Seeder;
use App\Akcesoria;

class AkcesoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Akcesoria::create([
        	'nazwa' => 'Kask'
        ]);

        Akcesoria::create([
        	'nazwa' => 'Rękawice'
        ]);

        Akcesoria::create([
        	'nazwa' => 'Kufer'
        ]);

        Akcesoria::create([
        	'nazwa' => 'Kamera GoPro'
        ]);

        Akcesoria::create([
        	'nazwa' => 'Nawigator'
        ]);
    }
}
