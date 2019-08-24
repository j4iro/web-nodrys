<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestRestaurant extends Model
{
    protected $table = "requests_restaurants";
    protected $guarded = ['_token'];
}
