<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\RedirectIfAuthenticated;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [AccountController::class, 'login'])->name('login');
    Route::post('/login-handler', [AccountController::class, 'loginHandler'])->name(
        'login.handler'
    );

    Route::get('/register', [AccountController::class, 'register'])->name('register');
    Route::post('/register-handler', [AccountController::class, 'registerHandler'])->name(
        'register.handler'
    );
});

Route::middleware('auth:customer')->group(function () {
    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'account'], function () {
        Route::get('/info', [AccountController::class, 'showInfo'])->name(
            'customer.info'
        );
        Route::post('/info/add-address', [AccountController::class, 'addCustomerAddress'])->name(
            'customer.info.address.add'
        );
        Route::put('/info/change-default-address/{customerAddressId}', [AccountController::class, 'changeDefaultCustomerAddress'])->name(
            'customer.info.change.default.address'
        );
        Route::delete('/info/address/delete/{customerAddressId}', [AccountController::class, 'deleteCustomerAddress'])->name(
            'customer.info.address.delete'
        );
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('', [OrderController::class, 'index'])->name(
            'order.index'
        );
        Route::get('/details/{orderId}', [OrderController::class, 'showDetails'])->name(
            'order.details'
        );
        Route::post('/place', [OrderController::class, 'placeOrder'])->name(
            'order.place'
        );
        Route::delete('/cancel/{orderId}', [OrderController::class, 'cancelOrder'])->name(
            'order.cancel'
        );
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('', [CartController::class, 'index'])->name(
            'cart.index'
        );
        Route::post('/item/change-quantity/{cartItemId}', [CartController::class, 'updateCartItemQuantity'])->name(
            'cart.item.quantity.change'
        );
        Route::delete('/item/delete/{cartItemId}', [CartController::class, 'deleteCartItem'])->name(
            'cart.item.delete'
        );
        Route::post('/add-item', [CartController::class, 'addProductToCart'])->name(
            'cart.add.item'
        );

        Route::get('/checkout', [CartController::class, 'checkout'])->name(
            'cart.checkout'
        );
    });
});

Route::get('/search', [ProductController::class, 'search'])->name(
    'product.search'
);
Route::get('/{productSlug}/details', [ProductController::class, 'showDetails'])->name(
    'product.details'
);
Route::get('/{categorySlug}', [ProductController::class, 'findByCategorySlug'])->name(
    'product.findBy.categorySlug'
);
