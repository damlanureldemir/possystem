<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable='transactions';

    public function getTransactions(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
