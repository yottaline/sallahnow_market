<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function(){
    // categories route
    Route::prefix('categories')->group(function(){
        Route::get('/', 'MarketCategoryController@index');
        Route::post('load', 'MarketCategoryController@load');
        Route::match(['post', 'put'], 'submit', 'MarketCategoryController@submit');
    });

    // subcategories
    Route::prefix('subcategories')->group(function(){
        Route::get('/', 'MarketSubcategoryController@index');
        Route::post('load', 'MarketSubcategoryController@load');
        Route::match(['post', 'put'], 'submit', 'MarketSubcategoryController@submit');
    });
});


Route::prefix('locations')->group(function(){
    Route::get('/', 'LocationController@index');
    Route::post('get_location', 'LocationController@getLocation');
    Route::post('load', 'LocationController@load');
});
Route::post('retailer_register', 'MarketRetailerController@register');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';