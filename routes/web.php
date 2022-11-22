<?php

use App\Http\Controllers\UserSearchActivityController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search-activity', [UserSearchActivityController::class, 'index'])->name('search-activity.index');
Route::get('/search-activity/get-activities', [UserSearchActivityController::class, 'getActivities'])->name('search-activity.getActivities');
Route::get('/search-activity/get-filters', [UserSearchActivityController::class, 'filters'])->name('search-activity.filters');


Route::get('/test', function () {
    return view('test');
});
