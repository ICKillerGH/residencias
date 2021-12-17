<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Career::create([
            'name' => 'Licenciatura en informática',
            'abreviation'=>'LI',
        ]);
        Career::create([
            'name' => 'Licenciatura en derecho',
            'abreviation'=>'LD',
        ]);
        
    }
}
