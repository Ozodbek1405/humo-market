<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopping_cart()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('pages.shopping-cart',compact('cartItems'));
    }

    public function addToCart(Request $request,$product_id)
    {
        $product_count = $request->product_count;
        $product = Product::find($product_id);
        Cart::instance('cart')
              ->add([
                  'id' => $product->id,
                  'name' => $product->name,
                  'qty' => $product_count,
                  'price' => $product->formatted_price,
                  'options' => ['image' => $product->formatted_images[0]]
                ])->associate('App\Models\Product');
        return redirect()->route('shopping.cart')->with('message','Item has been successfully!');
    }

    public function removeItem($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back()->with('message','Cart item remove!');
    }

    public function clearCart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back()->with('message','Cart items deleted!');
    }

    public function updateCart(Request $request)
    {
        Cart::instance('cart')->update($request->rowId,$request->quantity);
        return redirect()->route('shopping.cart')->with('message','Item has been updated!');
    }

    public function wishlist()
    {
        return view('pages.wishlist');
    }
}
