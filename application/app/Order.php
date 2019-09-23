<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['order_number','order_date','customer_id','seller_code','note','tax','discount','transport','total'];

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Product','order_products')->withPivot('qty','price_unit','total_line');
    }
}
