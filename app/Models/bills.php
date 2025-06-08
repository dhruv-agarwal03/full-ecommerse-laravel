<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bills extends Model
{
    //
    protected $table="bills";
    protected $fillable=['paymentMethod',	'information'	,'Dilevery'	,'updated_at'	,'created_at',	'orderplaced'];
}
