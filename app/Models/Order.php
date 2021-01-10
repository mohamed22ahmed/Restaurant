<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['client_id','restaurant_id','delivery_id','price','name','phone','address','food','restaurant'];
}
