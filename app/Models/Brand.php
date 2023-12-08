<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'order',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function category()
    {
        return $this->belongsToMany( Category::class, 'brand_categories', 'brand_id','category_id')->withPivot(['brand_id', 'category_id'])->withTimestamps();
    }

    public function getParentCategory()
    {
        return BrandCategory::query()->where('brand_id',$this->id)->get();
    }

    public function getParentCategoryArray()
    {
        return $this->getParentCategory()->pluck('category_id')->toArray();
    }

}
