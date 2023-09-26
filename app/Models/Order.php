<?php

namespace App\Models;

use App\Models\User;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['product_id','user_id','address','payment_status','delivery_status'];


    public function products(){

        return $this->belongsTo(Products::class,'product_id','id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
