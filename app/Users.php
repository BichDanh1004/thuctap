<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    public function roles(){
        return $this->belongsToMany('App\Role','id_role','id');
    }
    public function bills(){
        return $this->hasMany('App\Bill', 'id_customer', 'id_bill');
    }
    public function cart(){
        return $this->hasOne('App\Cart','id_customer','id_user');
    }
}
