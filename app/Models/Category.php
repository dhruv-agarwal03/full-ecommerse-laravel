<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $primaryKey='catId';
    protected $table="category";
    protected $fillable=['CID','	name','class'	];
}
