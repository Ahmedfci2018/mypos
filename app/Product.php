<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name' , 'description'];
    protected $guarded=[];

    protected $appends =['image_path' , 'profit_percent'];

    public function getImagePathAttribute(){

         return asset('uploads/product_images/'. $this->image);

    } //end of path

    public function getProfitPercentAttribute(){

        $profit = $this->sale_price - $this->purchase_price;

        // return $profit_percent
        return number_format($profit * 100 / $this->purchase_price ,2);

    }//end of profit percent method

    // Relation between Products & Categories
    public function category(){

        return $this->belongsTo(Category::class);

    }// end of categories

    public function orders(){

        return $this->belongsToMany(Order::class, 'product_order');

    }// end of categories


}// end of model
