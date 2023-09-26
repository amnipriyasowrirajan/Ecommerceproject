<?php

use App\Models\Brands;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StripeController;

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

Route::get('/', [UserController::class, 'showCorrectHomePage']);
       

Route::get('/register', [UserController::class, 'showRegister']);
Route::get('/login', [UserController::class, 'showLogin']);
// user registration storage
Route::post('/register', [UserController::class, 'register'])->middleware('guest');

// user login storage
Route::post('/login', [UserController::class, 'login'])->middleware('guest');

//Logout
Route::get('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');

Route::get('/admin', [UserController::class, 'adminPage'])->middleware('mustBeLoggedIn');
//show categories details
Route::get('/insert-categories/{id}', [UserController::class, 'showCategoriesEachId']);
// show brands details
Route::get('/insert-brands/{id}', [UserController::class, 'showBrandsEachId']);
// show search details
Route::get('/search',[UserController::class,'search']);
// show product details
Route::get('/product-details/{id}', [UserController::class, 'showProductDetails']);

//cancel_order
Route::get('/cancel_order/{id}',[UserController::class,'cancel_order']);

//add_comment
Route::post('/add_comment',[UserController::class,'add_comment']);

//add_comment
Route::post('/add_reply',[UserController::class,'add_reply']);

// show cart details
Route::post('/addToCart',[CartController::class,'addToCart'])->middleware('mustBeLoggedIn');

// view the cart
Route::get('/show-cart',[CartController::class,'showCart']);

// cart count
Route::get('/checkout',[UserController::class,'checkoutpage']);



//show_order
Route::get('/show_order',[UserController::class,'show_order']);

// Remove the cart

Route::get('/removecart/{id}',[CartController::class,'removeCart']);
// ->middleware('can:delete,cart')
// Edit the cart

// Route::get('/edit/{id}',[CartController::class,'showEditScreen']);

// checkout page using stripe

Route::get('/stripe/{total}',[StripeController::class,'stripe']);

// stripe card usage

Route::post('stripe/{total}',[StripeController::class,'stripePost'])->name('stripe.post');

// cash on delivery cash_order
Route::get('/cash_order',[StripeController::class,'cashOrder']);




// send_email

// Route::get('/send_email/{id}',[AdminController::class,'send_email']);


// Search in admin

Route::get('/admin_search',[AdminController::class,'admin_search']);
// insert product
Route::get('/insert-product', [AdminController::class, 'showInsertProduct']);
Route::post('/insert-product', [AdminController::class, 'insertProduct']);

// show_product
Route::get('/show_product', [AdminController::class, 'show_product']);

// delete_product
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);

Route::get('/insert-categories', [AdminController::class, 'showInsertCategories']);
Route::post('/insert-categories',[AdminController::class,"insertCategory"]);

Route::post('/insert-brands',[AdminController::class,"insertBrands"]);
Route::get('/insert-brands',[AdminController::class,"showInsertBrands"]);

// delete_category
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);
//delete_brand
Route::get('/delete_brand/{id}', [AdminController::class, 'delete_brand']);
//update_product
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
// update_product_confirm
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);

// order view in admin

Route::get('/order',[AdminController::class,'order']);

// delivered
Route::get('/delivered/{id}',[AdminController::class,'delivered']);

// print the pdf
Route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);


