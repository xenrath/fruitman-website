<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\BuyerController;
// use App\Http\Controllers\SellerController;
// use App\Http\Controllers\FarmerController;
// use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\IncomeController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ImageController;

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::match(['GET', 'POST'], '/register', function () {
    return redirect('login');
})->name('register');

Route::resource('user', UserController::class);
// Route::resource('buyer', BuyerController::class);
// Route::resource('seller', SellerController::class);
// Route::resource('farmer', FarmerController::class);
// Route::resource('category', CategoryController::class)->except('show');
Route::resource('product', ProductController::class);
// Route::resource('income', IncomeController::class);
Route::resource('bank', BankController::class);
Route::get('/category/{id}', [UserController::class, 'getCategory']);
Route::get('/cities/{id}', [ProductController::class, 'getCities']);
Route::get('/postal_code/{id}', [ProductController::class, 'getPostalCode']);
Route::get('/delete-image/{id}', [ImageController::class, 'deleteImage']);
Route::controller('test', [ProductController::class, 'test']);