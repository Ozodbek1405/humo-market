<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
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
        'brand_id',
        'parent_category_id',
        'child_category_id',
        'views',
        'count',
        'rate',
        'dimensions',
        'weight',
    ];

    public function size()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id')->withPivot(['product_id', 'size_id'])->withTimestamps();
    }

    public function shoe_size()
    {
        return $this->belongsToMany(ShoeSize::class, 'product_shoe_sizes', 'product_id')->withPivot(['product_id', 'shoe_size_id'])->withTimestamps();
    }

    public function product_color()
    {
        return $this->belongsToMany(Color::class, 'product_colors', 'product_id')->withPivot(['product_id', 'color_id'])->withTimestamps();
    }

    public function child_category()
    {
        return $this->belongsTo(ChildCategory::class);
    }


    public function getProductSize()
    {
        return ProductSize::query()->where('product_id',$this->id)->get();
    }

    public function getProductSizeArray()
    {
        return $this->getProductSize()->pluck('size_id')->toArray();
    }

    public function getProductShoeSize()
    {
        return ProductShoeSize::query()->where('product_id',$this->id)->get();
    }

    public function getProductShoeSizeArray()
    {
        return $this->getProductShoeSize()->pluck('shoe_size_id')->toArray();
    }

    public function getProductColor()
    {
        return ProductColor::query()->where('product_id',$this->id)->get();
    }

    public function getProductColorArray()
    {
        return $this->getProductColor()->pluck('color_id')->toArray();
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

    public function IssetWishlist()
    {
        return Cart::instance('wishlist')->content()->where('id',$this->id)->first();
    }
}
