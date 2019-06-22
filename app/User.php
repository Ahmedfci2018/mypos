<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'image',
    ];

    protected $appends =['image_path'];

    public function getFirstNameAttribute($value){

        return ucfirst($value);
    }

    public function getLastNameAttribute($value){

        return ucfirst($value);
    }

    public function getImagePathAttribute(){

        return asset('uploads/users_images/'. $this->image);
    } //end of path

    protected $hidden = [
        'password', 'remember_token',
    ];
}
