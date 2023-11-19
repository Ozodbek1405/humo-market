<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Review;

class ReviewObserver
{

    public function created(Review $review)
    {
        self::calculateRate($review);
    }

    public function updated(Review $review)
    {
        self::calculateRate($review);
    }

    public function deleted(Review $review)
    {
        self::calculateRate($review);
    }

    public function calculateRate($review)
    {
        $reviews = Review::query()->where('product_id',$review->product_id)->get();
        $rates = [];
        foreach ($reviews as $review){
            $rates[] = $review->rate;
        }
        $count = count($rates);
        $sum = array_sum($rates);
        $result = round($sum / $count);
        $product = Product::find($review->product_id);
        $product->rate = $result;
        $product->save();
    }

}
