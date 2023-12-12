<?php

namespace App\Services;


use App\Models\Product;

class ProductFilterService
{
    public function filters($products,$q_sort,$q_brands,$q_colors,$q_min,$q_max,$q_sizes,$q_shoe_sizes,$search)
    {
        if (isset($q_sort)){
            $products = match ((int)$q_sort) {
                1 => $products->latest(),
                2 => $products->orderByDesc('views'),
                3 => $products->orderByDesc('rate'),
                default => $products->orderBy('created_at'),
            };
        }
        if (isset($q_brands)){
            $products = $products->where(function ($query) use ($q_brands){
                $query->whereIn('brand_id',explode(',',$q_brands))->orWhereRaw("'".$q_brands."'=''");
            });
        }
        if (isset($q_colors)){
            $products = $products->whereHas("product_color", function ($query) use ($q_colors){
                $query->whereIn('color_id',explode(',',$q_colors))->orWhereRaw("'".$q_colors."'=''");
            });
        }
        if (isset($q_sizes) && $q_sizes != null){
            $products = $products->whereHas('size',function ($query) use ($q_sizes){
                $query->whereIn('size_id',explode(',',$q_sizes))->orWhereRaw("'".$q_sizes."'=''");
            });
        }
        if (isset($q_shoe_sizes) && $q_shoe_sizes != null){
            $products = $products->whereHas('shoe_size',function ($query) use ($q_shoe_sizes){
                $query->whereIn('shoe_size_id',explode(',',$q_shoe_sizes))->orWhereRaw("'".$q_shoe_sizes."'=''");
            });
        }
        if ($q_min != null && $q_max != null){
            $products = $products->wherebetween('price',[$q_min,$q_max]);
        }
        if (isset($search) && $search != null){
            $products = $products->where('name', 'LIKE', "%{$search}%");
        }
        return $products;
    }

    public static function minPrice()
    {
        $minPrice = Product::query()->pluck('price')->toArray();
        return min($minPrice);
    }

    public static function maxPrice()
    {
        $maxPrice = Product::query()->pluck('price')->toArray();
        return max($maxPrice);
    }

}
