<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['code','name','bar_code','description','price_unit','price_cost','avatar'];
}
