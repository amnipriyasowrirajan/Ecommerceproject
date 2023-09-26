<?php

namespace App\Models;

use App\Models\Brands;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_title',
        'product_description',
        'product_keywords',
        'category_id',
        'brand_id',
        'product_image1',
        'product_image2',
        'product_image3',
        'product_price'
    ];

    public function categories(){

        return $this->belongsTo(Categories::class,'category_id');
    }

    public function brands() {
        return $this->belongsTo(Brands::class, 'brand_id');
    }
}
