<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //Relacion One to Many
    public function restaurants()
    {
        return $this->hasMany('App\Restaurant');
    }
}
