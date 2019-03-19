<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    
    //Relación uno a muchos (Un restaurante tiene muchos platos)
    //Medio RARO
    public function dishes()
    {
        return $this->hasMany('App\Dish');
    }

    //Relacion uno a muchos (Un restaurante tiene muchas reservas)
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    //Relación de muchos a uno(Muchos restaurantes pueden tener un mismo distrito)
    public function district()
    {
        return $this->belongsTo('App\District','district_id');
    }

    //Relación de muchos a uno(Muchos restaurantes pueden tener una misma categoria)
    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }
}
