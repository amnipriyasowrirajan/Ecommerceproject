<?php

namespace App\Models;

use App\Models\User;
use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carts extends Model
{
    use HasFactory;
    protected $fillable=['product_id','quantity','user_id'];


    public function products(){

        return $this->belongsTo(Products::class,'product_id','id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
