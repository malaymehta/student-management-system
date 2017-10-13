<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserRoleTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AcademicYearsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(BatchesTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(ShiftsTableSeeder::class);
    }
}
