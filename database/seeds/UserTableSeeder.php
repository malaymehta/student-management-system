<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class)->create([
            'title'          => 'Mr.',
            'role_id'        => 1,
            'name'           => 'Murtaza',
            'email'          => 'murtaza.vhora@arsenaltech.com',
            'mob_no'         => '9999999999',
            'password'       => bcrypt('123456'),
            'department_id'  => 1,
            'designation_id' => 1,
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now()
        ]);
        factory(\App\Models\User::class)->create([
            'title'          => 'Mr.',
            'role_id'        => 1,
            'name'           => 'Prasad',
            'email'          => 'prasad.jhanshikar@arsenaltech.com',
            'mob_no'         => '8888888888',
            'password'       => bcrypt('123456'),
            'department_id'  => 1,
            'designation_id' => 1,
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now()
        ]);
    }
}
