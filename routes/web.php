<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogicController;
use App\Http\Controllers\NeduController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
Route::match(['get','post'],'/nedu', [NeduController::class, 'Nedu']);
Route::match(['get','post'],'/delete', [NeduController::class, 'delete']);

Route::match(['get','post'], '/', [LogicController::class, 'index']);
Route::match(['get','post'], '/about', [LogicController::class, 'about']);
Route::match(['get','post'], '/blog', [LogicController::class, 'blog']);
Route::match(['get','post'], '/contact', [LogicController::class, 'contact']);
Route::match(['get','post'], '/quote', [LogicController::class, 'quote']);
Route::match(['get','post'], "/quote-estimate", [LogicController::class, 'quote_estimate'])->name('data');
Route::match(['get','post'], '/placed-order', [LogicController::class, 'placed_order'])->name('placed');
Route::match(['get','post'], '/track-parcel', [LogicController::class, 'track_parcel']);

Route::match(['get','post'], '/blog-readmore', [LogicController::class, 'readMore_blog']);

Route::group(['middleware'=>"trans"], function(){

Route::match(['get','post'], '/dashboard', [AdminController::class, 'dashboard']);
Route::match(['get','post'], '/sign-up', [AdminController::class, 'sign_up']);
Route::match(['get','post'], '/login', [AdminController::class, 'login']);
Route::match(['get','post'], '/order-admin', [AdminController::class, 'order']);
Route::match(['get','post'], '/about-admin', [AdminController::class, 'about_admin']);
Route::match(['get','post'], '/settings', [AdminController::class, 'settings']);
Route::match(['get','post'], '/calculator', [AdminController::class, 'calculator']);
Route::match(['get','post'], '/edit-cal', [AdminController::class, 'edit_cal']);
Route::match(['get','post'], '/edit-cal', [AdminController::class, 'edit_cal']);
Route::match(['get','post'], '/readmore', [AdminController::class, 'readmore']);
Route::match(['get','post'], '/blog-admin', [AdminController::class, 'blog_admin']);
Route::match(['get','post'], '/add-blog', [AdminController::class, 'add_blog']);
Route::match(['get','post'], '/edit-blog', [AdminController::class, 'edit_blog']);
Route::match(['post', 'get'],'/delete/{id}', [AdminController::class, 'delete']);

Route::get('/logout', function(){

    if(session()->has('login')){
        // session()->pull('login');
        Session::flush();
    }
    return redirect('/login');
});


});