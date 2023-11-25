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
        'color_id',
        'size_id',
        'brand_id',
        'parent_category_id',
        'child_category_id',
        'views',
        'count',
        'rate',
        'dimensions',
        'weight',
    ];

    public function color()
    {
        return $this->belongsTo(Color::class,'color_id','id');
    }

    public function size()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id')->withPivot(['product_id', 'size_id'])->withTimestamps();
    }

    public function getProductSize()
    {
        return ProductSize::query()->where('product_id',$this->id)->get();
    }

    public function getProductSizeArray()
    {
        return $this->getProductSize()->pluck('size_id')->toArray();
    }

    public function getFormattedImagesAttribute()
    {
        return json_decode($this->images);
    }

    public function getFormattedDiscountAttribute()
    {
        return $this->discount == null ? $this->discount : $this->price;
    }

    public function getFormattedPriceAttribute()
    {
        return $this->discount == null ? $this->price : $this->discount;
    }
}
