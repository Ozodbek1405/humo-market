<?php

namespace App\Services;


use App\Models\ChildCategory;
use App\Models\ParentCategory;

class GetCategories
{
    public static function getParentCategory()
    {
        return ParentCategory::query()->get();
    }

    public static function getChildCategory()
    {
        return ChildCategory::query()->get();
    }
}
