<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dishes';
    protected $fillable = ['restaurant_id','name','description','price','time','image','type'];

    //Esto me sacará todos los platos de un restaurante
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant','restaurant_id');
    }
}
