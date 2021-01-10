<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monthly_sub extends Model
{
    protected $fillable=['id','subscription','price','period','supplier_name'];
}
