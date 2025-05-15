<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayhereController;
use Illuminate\Support\Facades\Auth;



Route::get('/', [HomeController::class, 'login_home'])->name('home.index');
Route::get('/dashboard', [HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/product/details/{id}', [HomeController::class, 'productDetails'])->name('product.details');
Route::match(['get', 'post'], '/product/addToCart/{id}', [CartController::class, 'addToCart'])->middleware(['auth','verified'])->name('product.addToCart');
Route::get('/cart', [CartController::class, 'cart'])->middleware(['auth','verified'])->name('home.cart');
Route::get('/delete_item/{id}', [CartController::class, 'delete_item'])->middleware(['auth','verified'])->name('home.delete_item');
Route::post('/cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::get('/why_us', [HomeController::class, 'whyUs'])->name('home.why_us');
Route::get('/home', [HomeController::class, 'home'])->name('home.index');
Route::get('/testimonial', [HomeController::class, 'Testimonial'])->name('home.testimonial');
Route::get('/contact', [HomeController::class, 'ContactUs'])->name('home.contact_us');
Route::get('/products', [HomeController::class, 'home'])->name('home.product');
Route::post('/product/addToCartInProductDetail/{id}', [CartController::class, 'addToCartInProductDetail'])->name('product.addToCartInProductDetail');

Route::post('/custom-logout', [HomeController::class, 'customLogout'])->name('custom.logout');


Route::middleware('auth')->group(function () {
    Route::post('/checkout', [PayhereController::class, 'checkout'])->name('payhere.checkout');
    Route::get('/payment/return', [PayhereController::class, 'return'])->name('payhere.return');
    Route::get('/payment/cancel', [PayhereController::class, 'cancel'])->name('payhere.cancel');
    
});
Route::post('/payment/notify', [PayhereController::class, 'notify'])->name('payhere.notify');



Route::post('/testimonials', [HomeController::class, 'store_testimonial'])->name('testimonial');















Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
});

require __DIR__.'/auth.php';

route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth','admin']);
route::get('view_category',[AdminController::class,'view_category'])->middleware(['auth','admin']);
route::post('add_category',[AdminController::class,'add_category'])->middleware(['auth','admin']);
route::get('delete_category/{id}',[AdminController::class,'delete_category'])->middleware(['auth','admin']);
route::get('edit_category/{id}',[AdminController::class,'edit_category'])->middleware(['auth','admin']);
route::post('update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth', 'admin']);
route::get('add_product',[AdminController::class,'add_product'])->middleware(['auth','admin']);
route::post('upload_product',[AdminController::class,'upload_product'])->middleware(['auth','admin']);
route::get('view_product',[AdminController::class,'view_product'])->middleware(['auth','admin']);
route::get('delete_product/{id}',[AdminController::class,'delete_product'])->middleware(['auth','admin']);
route::get('update_product/{id}',[AdminController::class,'update_product'])->middleware(['auth','admin']);
route::put('update_product/{id}',[AdminController::class,'update_product_data'])->middleware(['auth','admin']);
route::get('search_product/',[AdminController::class,'search_product'])->middleware(['auth','admin']);

