<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['category 1' , 'category 2' , 'category 3'];

        foreach ($categories as $category){

            \App\Category::create([
                'ar'=> ['name' => $category.' ar'],
                'en'=> ['name' => $category.' en'],
            ]);

        } // end of foreach

    } // end of function
}
