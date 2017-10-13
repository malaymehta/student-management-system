<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\UserRole::class)->create([
            'role_name'  => 'Super Admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        factory(\App\Models\UserRole::class)->create([
            'role_name'  => 'Admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        factory(\App\Models\UserRole::class)->create([
            'role_name'  => 'Account Manager',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        factory(\App\Models\UserRole::class)->create([
            'role_name'  => 'Employee',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        factory(\App\Models\UserRole::class)->create([
            'role_name'  => 'Hiring Manager',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        factory(\App\Models\UserRole::class)->create([
            'role_name'  => 'Recruiter',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
