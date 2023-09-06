<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';

    public function getProduct(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function getDetailProduct(){
        return $this->hasMany(Order_Detail::class,'product_id','id');
    }

}
