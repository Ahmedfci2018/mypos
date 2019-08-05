<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products=['product 1', 'product 2'];

        foreach ($products as $product){

            \App\Product::create([

                'category_id'=>1,
                'ar'=>['name'=> $product . ' ar', 'description'=> $product . ' arabic description '],
                'en'=>['name'=> $product . ' en', 'description'=> $product . ' english description '],
                'purchase_price'=>100,
                'sale_price'=>150,
                'stock'=>100,
            ]);

        } // end of foreach

    }// end of run

} //end of seeder
