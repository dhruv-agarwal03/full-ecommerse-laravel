<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class catimage extends Model
{
    //
    protected $primaryKey='id';
    protected $table="categeryimage";
    protected $fillable=['cat_id','image'];
}
