<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LocationSeeder::class,
            CareerSeeder::class,
        ]);

        $user = User::factory()->create([
            'email' => 'admin@admin.com',
            'role' => User::ADMIN_ROLE,
        ]);

        $user->admin()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
        ]);

        $user = User::factory()->create([
            'email' => 'oralis@gmail.com',
            'role' => User::STUDENT_ROLE,
        ]);

        $user->student()->create([
            'first_name' => 'Oralis',
            'fathers_last_name' => 'Valerio',
            'mothers_last_name' => 'Vargas',
            'account_number' => '0102032323232',
            'sex' => 'f',
            'curp' => '12356456454564466',
            'career_percentage' => 90,
            'phone_number' => '4261249733',
            'is_enrolled' => true,
            'is_social_service_concluded' => true,
            'career_id' => 1,
            'state_id' => 1,
            'municipality_id' => 2,
            'locality_id' => 3,
        ]);
    }
}
