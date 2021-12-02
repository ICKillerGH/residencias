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
        Career::create(['name' => 'Licenciatura en informática']);
        Career::create(['name' => 'Licenciatura en derecho']);
    }
}
