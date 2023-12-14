<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\District;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopping_cart()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('carts.shopping-cart',compact('cartItems'));
    }

    public function addToCart(AddToCartRequest $request,$product_id)
    {
        $product_count = $request->product_count;
        $product_color_id = $request->color;
        $product_size = $request->size;
        $product_shoe_size = $request->shoe_size;
        $product = Product::find($product_id);
        Cart::instance('cart')
              ->add([
                  'id' => $product->id,
                  'name' => $product->name,
                  'qty' => $product_count,
                  'price' => $product->formatted_price,
                  'options' => [
                      'image' => $product->formatted_images[0],
                      'color_id' => $product_color_id,
                      'size_id' => $product_size,
                      'shoe_size_id' => $product_shoe_size,
                  ]
                ])->associate('App\Models\Product');
        return redirect()->back()->with('message','Item has been successfully!');
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

    public function getDistricts(Request $request)
    {
        $region_id = $request->region_id;
        $districts = District::query()->where('region_id',$region_id)->get();
        return ['data' => $districts];
    }

}
