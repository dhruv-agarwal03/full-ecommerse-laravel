<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class billItem extends Model
{
    //
    protected $table="billitem";
    protected $fillable=['billId',	'productId',	'qty'	,'sellproce'	,'gst'	,'created_at',	'updated_at'];
}
