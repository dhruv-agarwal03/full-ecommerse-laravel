<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    //
    protected $primaryKey = 'productId';

    protected $table="products";
    protected $fillable=['productId	','HSNcode','costprice	','sellingPrice','sell1','sell2','	MRP	','qualityNo	','gst	expirs	','category	','priorty	','Available	','created_at	','updated_at'];
}
