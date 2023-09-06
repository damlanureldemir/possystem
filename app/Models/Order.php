<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function getOrder(){
        return $this->belongsTo(Order_Detail::class,'order_id','id');
    }
}
