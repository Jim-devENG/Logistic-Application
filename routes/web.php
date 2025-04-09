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
Route::match(['get','post'],'/nedu', [NeduController::class, 'Nedu'])->name('nedu');
Route::match(['get','post'],'/delete', [NeduController::class, 'delete'])->name('delete');

Route::match(['get','post'], '/', [LogicController::class, 'index'])->name('home');
Route::match(['get','post'], '/about', [LogicController::class, 'about'])->name('about');
Route::match(['get','post'], '/blog', [LogicController::class, 'blog'])->name('blog');
Route::match(['get','post'], '/contact', [LogicController::class, 'contact'])->name('contact');
Route::match(['get','post'], '/quote', [LogicController::class, 'quote'])->name('quote');
Route::match(['get','post'], "/quote-estimate", [LogicController::class, 'quote_estimate'])->name('quote.estimate');
Route::match(['get','post'], '/placed-order', [LogicController::class, 'placed_order'])->name('order.placed');
Route::match(['get','post'], '/track-parcel', [LogicController::class, 'track_parcel'])->name('track.parcel');

Route::match(['get','post'], '/blog-readmore', [LogicController::class, 'readMore_blog'])->name('blog.readmore');

Route::group(['middleware'=>"trans"], function(){

Route::match(['get','post'], '/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::match(['get','post'], '/sign-up', [AdminController::class, 'sign_up'])->name('admin.signup');
Route::match(['get','post'], '/login', [AdminController::class, 'login'])->name('admin.login');
Route::match(['get','post'], '/order-admin', [AdminController::class, 'order'])->name('admin.order');
Route::match(['get','post'], '/about-admin', [AdminController::class, 'about_admin'])->name('admin.about');
Route::match(['get','post'], '/settings', [AdminController::class, 'settings'])->name('admin.settings');
Route::match(['get','post'], '/calculator', [AdminController::class, 'calculator'])->name('admin.calculator');
Route::match(['get','post'], '/edit-cal', [AdminController::class, 'edit_cal'])->name('admin.calculator.edit');
Route::match(['get','post'], '/readmore', [AdminController::class, 'readmore'])->name('admin.readmore');
Route::match(['get','post'], '/blog-admin', [AdminController::class, 'blog_admin'])->name('admin.blog');
Route::match(['get','post'], '/add-blog', [AdminController::class, 'add_blog'])->name('admin.blog.add');
Route::match(['get','post'], '/edit-blog', [AdminController::class, 'edit_blog'])->name('admin.blog.edit');
Route::match(['post', 'get'],'/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

Route::get('/logout', function(){
    Session::flush();
    return redirect()->route('admin.login');
})->name('admin.logout');


});