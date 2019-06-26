<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menus";
    //Relacion One to Many
    public function restaurants()
    {
        return $this->hasMany('App\Restaurant');
    }
}
