<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    protected $table = 'order_products';
    protected $fillable = ['order_id','product_id','qty','price_unit','total_line'];

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
