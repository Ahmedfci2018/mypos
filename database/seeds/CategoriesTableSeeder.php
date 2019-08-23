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
        $categories_ar = ['قسم 1' , 'قسم 2' , 'قسم 3'];
        $categories_en = ['category 1' , 'category 2' , 'category 3'];

        foreach ($categories_ar as $index=>$category){

            \App\Category::create([
                'ar'=> ['name' => $category],
                'en'=> ['name' => $categories_en[$index]],
            ]);

        } // end of foreach

    } // end of function
}
