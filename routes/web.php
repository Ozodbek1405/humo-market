<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SendCodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/code',[SendCodeController::class,'code'])->name('send.code');
Route::get('/reset/view',[ResetPasswordController::class,'resetView'])->name('reset.view');
Route::post('/reset/code',[SendCodeController::class,'reset_code'])->name('reset.code');
Route::post('/password/changes',[ResetPasswordController::class,'password_change'])->name('change.password');

