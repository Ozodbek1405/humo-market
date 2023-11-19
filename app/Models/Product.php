<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'discount',
        'description',
        'title',
        'images',
        'product_colors_id',
        'product_sizes_id',
        'brand_id',
        'parent_category_id',
        'child_category_id',
        'views',
        'count',
        'rate',
        'dimensions',
        'weight',
    ];

    public function product_color()
    {
        return $this->belongsTo(ProductColor::class,'product_colors_id','id');
    }

    public function product_size()
    {
        return $this->belongsTo(ProductSize::class,'product_sizes_id','id');
    }

    public function getFormattedImagesAttribute()
    {
        return json_decode($this->images);
    }

    public function getFormattedDiscountAttribute()
    {
        return $this->discount == null ? $this->discount : $this->price . " so'm";
    }

    public function getFormattedPriceAttribute()
    {
        return $this->discount == null ? $this->price : $this->discount;
    }
}
