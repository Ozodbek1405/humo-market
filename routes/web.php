<?php

use App\Http\Controllers\{AboutController,
    Admin\AdminBrandsController,
    Admin\AdminProductController,
    Auth\LoginController,
    Auth\RegisterController,
    Auth\ResetController,
    BlogController,
    ContactController,
    FaqController,
    HomeController,
    OrderController,
    ProductController,
    ProfileController,
    ReviewController,
    ShopController,
    WishlistController};
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/products',[AdminProductController::class,'index'])->name('product.admin.view');
    Route::get('/products/create',[AdminProductController::class,'create'])->name('product.create');
    Route::get('/get/childCategory',[AdminProductController::class,'getChildCategory'])->name('getChildCategory');
    Route::get('/get/brands',[AdminProductController::class,'getBrands'])->name('getBrands');
    Route::post('/products/store',[AdminProductController::class,'productStore'])->name('products.store');
    Route::get('/products/delete/{product_id}',[AdminProductController::class,'productDelete'])->name('products.delete');
    Route::get('/products/edit/{product_id}',[AdminProductController::class,'edit'])->name('product.edit');
    Route::post('/products/update/{product_id}',[AdminProductController::class,'update'])->name('product.update');

    Route::get('brands',[AdminBrandsController::class,'brands'])->name('brands.admin.view');
    Route::get('/brands/create',[AdminBrandsController::class,'create'])->name('brands.admin.create');
    Route::post('/brands/store',[AdminBrandsController::class,'store'])->name('brands.admin.store');
    Route::get('/brands/delete/{brand_id}',[AdminBrandsController::class,'delete'])->name('brands.admin.delete');
    Route::get('/brands/edit/{brand_id}',[AdminBrandsController::class,'edit'])->name('brands.admin.edit');
    Route::post('/brands/update/{brand_id}',[AdminBrandsController::class,'update'])->name('brands.admin.update');
});

Route::group(['middleware' => 'auth'], static function () {
    Route::prefix('profile')->group(function () {
        Route::get('/{user_id}',[ProfileController::class,'profile'])->name('profile');
        Route::post('/change/{user_id}',[ProfileController::class,'profileChange'])->name('change.profile');
        Route::get('/change/password/{user_id}',[ProfileController::class,'changePasswordProfile'])->name('change.profile.password');
        Route::post('/password/{user_id}',[ProfileController::class,'changeProfile'])->name('changeProfile.password');
    });
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login',[LoginController::class,'login'])->name('login');
    Route::post('/loginPost',[LoginController::class,'loginPost'])->name('loginPost');
    Route::get('/register',[RegisterController::class,'register'])->name('register');
    Route::post('/registerPost',[RegisterController::class,'registerPost'])->name('post.register');
    Route::get('/logout', [LoginController::class,'logout'])->name('logout.perform');
    Route::get('google', [LoginController::class, 'redirectToGoogle'])->name('redirectToGoogle');
    Route::get('google/callback', [LoginController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');
});

Route::group(['prefix' => 'reset'], function () {
    Route::get('/',[ResetController::class,'reset'])->name('reset');
    Route::post('/submit',[ResetController::class,'resetSubmit'])->name('reset.submit');
    Route::get('/code',[ResetController::class,'code'])->name('code');
    Route::post('/code/submit',[ResetController::class,'codeSubmit'])->name('reset.code');
    Route::get('/change',[ResetController::class,'change'])->name('change');
    Route::post('/change/password',[ResetController::class,'changePassword'])->name('change.password');
});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/about',[AboutController::class,'about'])->name('about');
Route::get('/contact',[ContactController::class,'contact'])->name('contact');
Route::post('/contact/message',[ContactController::class,'send_message'])->name('contact.message');
Route::get('/blog',[BlogController::class,'blog'])->name('blog');
Route::get('/blog/detail/{blog_id}',[BlogController::class,'blog_detail'])->name('blog.detail');
Route::get('faq-help',[FaqController::class,'index'])->name('faq.help');


Route::get('/product/category/all',[ProductController::class,'productAll'])->name('product.category.all');
Route::get('/products',[ProductController::class,'product'])->name('product.view');
Route::get('/products/detail/{product_id}',[ProductController::class,'product_detail'])->name('product.detail');
Route::post('/review',[ReviewController::class,'review'])->name('review');

Route::group(['prefix' => 'cart'], function () {
    Route::get('/',[ShopController::class,'shopping_cart'])->name('shopping.cart');
    Route::post('/add/{product_id}',[ShopController::class,'addToCart'])->name('addToCart');
    Route::get('/clear',[ShopController::class,'clearCart'])->name('clearCart');
    Route::put('/update',[ShopController::class,'updateCart'])->name('updateCart');
    Route::get('/removeItem/{rowId}',[ShopController::class,'removeItem'])->name('removeItem');
    Route::get('/districts',[ShopController::class,'getDistricts'])->name('cart.districts');
    Route::get('/calculateData',[ShopController::class,'getCalculateData'])->name('calculate.data');
});

Route::group(['prefix' => 'wishlist'], function () {
    Route::get('/',[WishlistController::class,'wishlist'])->name('wishlist');
    Route::get('/removeItem/{rowId}',[WishlistController::class,'removeItem'])->name('removeItem.wishlist');
    Route::get('/add/{product_id}',[WishlistController::class,'addWishlist'])->name('addWishlist');
    Route::get('/clear',[WishlistController::class,'clear'])->name('clear.wishlist');
});

Route::group(['prefix' => 'orders'], function () {
    Route::get('/',[OrderController::class,'order'])->name('orders.view');
    Route::get('/payment',[OrderController::class,'payment'])->name('payment.view');
});


