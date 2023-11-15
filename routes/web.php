<?php

use App\Http\Controllers\{AboutController,
    Auth\LoginController,
    Auth\RegisterController,
    Auth\ResetController,
    BlogController,
    ContactController,
    HomeController,
    ProductController,
    ProfileController,
    ShopController};
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
});
Route::group(['middleware' => 'auth'], static function () {
    Route::prefix('profile')->group(function () {
        Route::get('/{user_id}',[ProfileController::class,'profile'])->name('profile');
        Route::post('/change/{user_id}',[ProfileController::class,'profileChange'])->name('change.profile');
        Route::get('/change/password/{user_id}',[ProfileController::class,'changePasswordProfile'])->name('change.profile.password');
        Route::post('/password/{user_id}',[ProfileController::class,'changeProfile'])->name('changeProfile.password');
    });
});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/login/post',[LoginController::class,'loginPost'])->name('loginPost');
Route::get('/register',[RegisterController::class,'register'])->name('register');
Route::post('/register/post',[RegisterController::class,'registerPost'])->name('post.register');
Route::get('/logout', [LoginController::class,'logout'])->name('logout.perform');
Route::get('/reset',[ResetController::class,'reset'])->name('reset');
Route::post('/reset/submit',[ResetController::class,'resetSubmit'])->name('reset.submit');
Route::get('/code',[ResetController::class,'code'])->name('code');
Route::post('/code/submit',[ResetController::class,'codeSubmit'])->name('reset.code');
Route::get('/change',[ResetController::class,'change'])->name('change');
Route::post('/change/password',[ResetController::class,'changePassword'])->name('change.password');
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('redirectToGoogle');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');
Route::get('/about',[AboutController::class,'about'])->name('about');
Route::get('/contact',[ContactController::class,'contact'])->name('contact');
Route::post('/contact/message',[ContactController::class,'send_message'])->name('contact.message');
Route::get('/product',[ProductController::class,'product'])->name('product');
Route::get('/product/detail',[ProductController::class,'product_detail'])->name('product.detail');
Route::get('/shopping-cart',[ShopController::class,'shopping_cart'])->name('shopping.cart');
Route::get('/wishlist',[ShopController::class,'wishlist'])->name('wishlist');
Route::get('/blog',[BlogController::class,'blog'])->name('blog');
Route::get('/blog/detail',[BlogController::class,'blog_detail'])->name('blog.detail');


