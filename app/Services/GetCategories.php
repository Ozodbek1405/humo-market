<?php

namespace App\Services;


use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\ParentCategory;

class GetCategories
{
    public static function getCategory()
    {
        return Category::query()->get();
    }

    public static function getParentCategory()
    {
        return ParentCategory::query()->get();
    }

    public static function getChildCategory()
    {
        return ChildCategory::query()->get();
    }
}
