<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valoration extends Model
{
    protected $table = 'valorations';
    protected $fillable=['user_id','restaurant_id','score'];
}
