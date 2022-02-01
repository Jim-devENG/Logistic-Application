<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/blogApi', [LogicController::class, 'blogApi']);
Route::get('/blogApi/{id}', [LogicController::class, 'singleBlogApi']);
Route::get('/author', [LogicController::class, 'author']);

Route::match(['get','post'], '/add-blog-api', [AdminController::class, 'add_blog_api']);
Route::match(['get','post','PUT'], '/edit-blog-api', [AdminController::class, 'edit_blog_api']);
Route::match(['get','post','PUT'], '/delete-blog-api/{id}', [AdminController::class, 'deleteBlog']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
