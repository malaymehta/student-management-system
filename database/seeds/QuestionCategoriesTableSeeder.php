<?php

use Illuminate\Database\Seeder;

class QuestionCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\QuestionCategories::class, 2)->create();
    }
}
