<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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


// Route Home Controller
Route::get('/redirect',[HomeController::class , 'redirect'])->middleware(['auth','verified']);
Route::get('/',[HomeController::class , 'index']);
Route::get('/Product_details/{id}',[HomeController::class,'Product_details']);
Route::post('/add_cart/{id}',[HomeController::class , 'add_cart']);
Route::get('show_cart',[HomeController::class , 'show_cart']);
Route::get('remove_product/{id}',[HomeController::class , 'remove_product']);
Route::get('cash_order',[HomeController::class , 'cash_order']);
Route::get('stripe/{total_price}',[HomeController::class , 'stripe']);
Route::get('show_order',[HomeController::class , 'show_order']);
Route::get('cancel_order/{id}',[HomeController::class , 'cancel_order']);
Route::post('add_comment',[HomeController::class , 'add_comment']);
Route::post('reply_comment',[HomeController::class , 'reply_comment']);
Route::get('search',[HomeController::class , 'search']);
Route::get('products',[HomeController::class , 'products']);
Route::get('search_product',[HomeController::class , 'search_product']);
// Stripe Route Post
Route::post('stripe/{total_price}', [HomeController::class , 'stripePost'])->name('stripe.post');




// Route Admin Controller
Route::get('/view_category',[AdminController::class , 'view_category']);
Route::post('/add_category',[AdminController::class , 'add_category']);
Route::get('/delete_category/{id}',[AdminController::class , 'delete_category']);
Route::get('/view_product',[AdminController::class , 'view_product']);
Route::post('add_product',[AdminController::class , 'add_product']);
Route::get('/show_product',[AdminController::class , 'show_product']);
Route::get('/delete_product/{id}',[AdminController::class , 'delete_product']);
Route::get('/update_product/{id}',[AdminController::class , 'update_product']);
Route::post('/edit_product_confirm/{id}',[AdminController::class , 'edit_product_confirm']);
Route::get('orders',[AdminController::class , 'orders']);
Route::get('delivered/{id}',[AdminController::class , 'delivered']);
Route::get('print_pdf/{id}',[AdminController::class , 'print_pdf']);
Route::get('send_email/{id}',[AdminController::class , 'send_email']);
Route::post('send_email_user/{id}',[AdminController::class , 'send_email_user']);
Route::get('order_search',[AdminController::class , 'order_search']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
