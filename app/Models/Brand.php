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

    public function parent()
    {
        return $this->belongsToMany( ParentCategory::class, 'brand_parent_categories', 'brand_id','parent_id')->withPivot(['brand_id', 'parent_id'])->withTimestamps();
    }

    public function getParentCategory()
    {
        return BrandParentCategory::query()->where('brand_id',$this->id)->get();
    }

    public function getParentCategoryArray()
    {
        return $this->getParentCategory()->pluck('parent_id')->toArray();
    }

}
