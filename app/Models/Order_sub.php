<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_sub extends Model
{
    protected $fillable=['id','sub_id','name','address','phone','date','notes'];
}
