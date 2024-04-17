<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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


Route::post('login', 'App\Http\Controllers\LoginController@index');
Route::post('register', 'App\Http\Controllers\RegisterController@index');

// Sonraki yönlendirmeler Sanctum kontrolü üzerinden geçecek.
Route::middleware('auth:sanctum')->get('blog', 'App\Http\Controllers\BlogController@getBlog');
Route::middleware('auth:sanctum')->post('blog', 'App\Http\Controllers\BlogController@addBlog');
Route::middleware('auth:sanctum')->delete('blog', 'App\Http\Controllers\BlogController@deleteBlog');
