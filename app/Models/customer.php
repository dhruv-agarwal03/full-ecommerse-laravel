<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    protected $table="customers";
    protected $fillable=['fname', 'lname', 'number','prioty', 'password', 'email','address', 'city', 'state', 'pincode', 'created_at'];
}
