<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "Menus";

    //Relacion One to Many
    public function restaurants()
    {
        return $this->hasMany('App\Restaurant');
    }
}
