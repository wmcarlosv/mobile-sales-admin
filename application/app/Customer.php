<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['dni','full_name','email','phone','city','address','note','seller_code','status'];
}