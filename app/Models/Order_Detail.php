<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    use HasFactory;
    protected $table='order_details';

    public function getdetail(){
        return $this->hasMany(Product::class,'product_id','id');
    }
    public function  getOrderDetail(){
        return $this->hasMany(Order::class,'order_id','id');
    }
}
