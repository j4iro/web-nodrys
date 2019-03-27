<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Dish extends Model
{
    protected $table='dishes';

    //Relación muchos a uno (Muchos platos pueden tener un mismo restaurante)
    //Esto me sacará todos los platos de un restaurante

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant','restaurant_id');
    }

}
