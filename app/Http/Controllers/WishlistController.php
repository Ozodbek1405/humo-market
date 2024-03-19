<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    public function wishlist()
    {
        $wishlistItems = Cart::instance('wishlist')->content();
        return view('carts.wishlist',compact('wishlistItems'));
    }

    public function addWishlist($product_id)
    {
        $product = Product::find($product_id);
        Cart::instance('wishlist')
            ->add([
                'id' => $product->id,
                'name_uz' => $product->name_uz,
                'name_en' => $product->name_en,
                'name_ru' => $product->name_ru,
                'price' => $product->formatted_price,
                'qty' => 1,
                'options' => ['image' => $product->formatted_images[0]]
            ])->associate('App\Models\Product');
        return redirect()->back()->with('message','Item has been successfully!');
    }

    public function removeItem($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        return redirect()->back()->with('message','Wishlist item remove!');
    }

    public function clear()
    {
        Cart::instance('wishlist')->destroy();
        return redirect()->back()->with('message','Wishlist all deleted!');
    }


}
