<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::factory()->create([
            'email' => 'admin@admin.com',
            'role' => User::ADMIN_ROLE,
        ]);

        $adminUser->admin()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
        ]);

        $teacherUser = User::factory()->create([
            'email' => 'pedro@gmail.com',
            'role' => User::TEACHER_ROLE,
        ]);

        $teacherUser->teacher()->create([
            'first_name' => 'Oralis',
            'fathers_last_name' => 'Valerio',
            'mothers_last_name' => 'Vargas',
            'sex' => 'f',
            'curp' => '12356456454564466',
            'phone_number' => '4261249733',
            'state_id' => 1,
            'municipality_id' => 2,
            'locality_id' => 3,
        ]);

        $studentUser = User::factory()->create([
            'email' => 'oralis@gmail.com',
            'role' => User::STUDENT_ROLE,
        ]);

        $studentUser->student()->create([
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
            'teacher_id' => $teacherUser->id,
            'state_id' => 1,
            'municipality_id' => 2,
            'locality_id' => 3,
        ]);
    }
}