<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Department::class, function () {
    return [
        'name'       => 'department_name',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});

$factory->define(App\Models\Designation::class, function () {
    return [
        'name'       => 'Principal',
        'alias'      => 'Principal',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now()
    ];
});

$factory->define(App\Models\UserRole::class, function () {
    return [
        'role_name'  => 'role_name',
        'added_by'   => 1,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});

$factory->define(App\Models\AcademicYears::class, function(Faker\Generator $faker){

    return [
        'name'=>date('Y').'-'.date('y', strtotime('+1 years')),
        'start_date'=>date('Y-m-d'),
        'end_date'=>date('Y-m-d', strtotime('+1 years')),
        'status'=>date(1),
    ];

});

$factory->define(App\Models\Courses::class, function(Faker\Generator $faker){

    return [
        'name'=>'Course-'.$faker->randomDigit,
        'alias'=>'Alias-'.$faker->randomDigit,
        'code'=>'Code'.$faker->randomDigit,
    ];

});

$factory->define(App\Models\Batches::class, function(Faker\Generator $faker){

    return [
        'name'=>'Course-'.$faker->randomDigit,
        'alias'=>'Alias-'.$faker->randomDigit,
        'start_date'=>date('Y-m-d'),
        'end_date'=>date('Y-m-d', strtotime('+1 years')),
        'academic_year_id'=>1,//factory(App\Models\AcademicYears::class)->create()->id,
        'course_id'=>1,//factory(App\Models\Courses::class)->create()->id,
        'status'=>1,
    ];

});

$factory->define(App\Models\Subjects::class, function(Faker\Generator $faker){
    return [
        'name'=>'Sub-'.$faker->randomDigit,
        'alias'=>'Alias-'.$faker->randomDigit,
        'code'=>'Code'.$faker->randomDigit,
    ];
});



$factory->define(App\Models\Sections::class, function(Faker\Generator $faker){

    return [
        'name'=>'Course-'.$faker->randomDigit,
        'academic_year_id'=>1,//factory(App\Models\AcademicYears::class)->create()->id,
        'batch_id'=>1,//factory(App\Models\Batches::class)->create()->id,
        'status'=>1,
    ];

});


$factory->define(App\Models\Shifts::class, function(Faker\Generator $faker){

    return [
        'name'=>'Morning Shift',
        'start_time'=>'09:00:00',
        'end_time'=>'20:00:00',
    ];

});


$factory->define(App\Models\QuestionCategories::class, function(Faker\Generator $faker){

    return [
        'name'=>'Category-'.$faker->randomDigit,
        'description'=>$faker->text,
        'course_id'=>1,
    ];

});
