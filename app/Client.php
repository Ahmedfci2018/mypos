<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $guarded=[];
    protected $casts=[
        'phone'=> 'array',
    ];

    // one to many relation between client and orders
    public function orders(){

       return $this->hasMany(Order::class);

    } // end of orders

    //set first char of client name in capital case
    public function getNameAttribute($value){

        return ucfirst($value);

    } // end of attribute

} // end of Client
