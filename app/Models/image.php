<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    //
    protected $table='image';
    protected $fillable=['product_id','image'];
}
