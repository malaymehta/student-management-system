<?php

use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Designation::class)->create([
            'name'       => 'Student Counseler',
            'alias'      => 'Stu-Coun',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        factory(\App\Models\Designation::class)->create([
            'name'       => 'Driver',
            'alias'      => 'Driver',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        factory(\App\Models\Designation::class)->create([
            'name'       => 'Warden',
            'alias'      => 'Warden',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        factory(\App\Models\Designation::class)->create([
            'name'       => 'Librarian',
            'alias'      => 'Librarian',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        factory(\App\Models\Designation::class)->create([
            'name'       => 'Peon',
            'alias'      => 'Peon',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        factory(\App\Models\Designation::class)->create([
            'name'       => 'Accountant',
            'alias'      => 'Accountant',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        factory(\App\Models\Designation::class)->create([
            'name'       => 'Clerk',
            'alias'      => 'Clerk',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        factory(\App\Models\Designation::class)->create([
            'name'       => 'Professor',
            'alias'      => 'Prof',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        factory(\App\Models\Designation::class)->create([
            'name'       => 'Principal',
            'alias'      => 'Principal',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
