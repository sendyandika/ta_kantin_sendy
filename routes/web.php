<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function (){
//     return view('');
// });
Route::get('/admin', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/confirm/{id}', [DashboardController::class, 'confirmOrder'])->name('dashboard.confirm');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', AdminMiddleware::class])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    // Route::middleware('admin')->group(function () {
    //     Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    // });

    Route::middleware(['auth', AdminMiddleware::class])->prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menu');
        Route::get('/tambah', [MenuController::class, 'create'])->name('menu.new');
        Route::post('/store', [MenuController::class, 'store'])->name('menu.store');
        Route::delete('/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('/update/{id}', [MenuController::class, 'update'])->name('menu.update');
    }); 
    
    

    // Route::middleware(['auth', 'admin'])->group(function () {
    //     Route::get('/admin', function () {
    //         return 'Admin Page';
    //     })->name('admin.dashboard');
    // });
    // Route::middleware(['customer'])->group(function () {
    //     Route::get('/', [CustomerController::class, 'index'])->name('customer.dashboard');
    //     Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    // });

    Route::get('/', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
        Route::post('/', [CustomerAuthController::class, 'login']);

    Route::prefix('customer')->group(function () {
        // Login & Register
        
        
        Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
        Route::post('/register', [CustomerAuthController::class, 'register']);
        
        Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

        // Route::post('/beli-menu/{id}', [CustomerController::class, 'checkout'])->name('customer.cart');

        Route::post('/cart/{id}', [CartController::class, 'addToCart'])->name('customer.cart');

        Route::get('/cart', [CartController::class, 'viewCart'])->name('customer.viewCart');

        // Route::delete('/cart/delete/{id}', [CustomerController::class, 'hapusCart'])->name('customer.cart.delete');


        Route::post('/customer/cart/checkout', [CartController::class, 'checkout'])->name('customer.cart.checkout');


        Route::delete('/cart/{id}', [CartController::class, 'removeCart'])->name('customer.cart.delete');

        Route::middleware(['auth', CustomerMiddleware::class])->group(function () {
            Route::get('/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');

            Route::get('/pesanan-saya', [CustomerController::class, 'pesananSaya'])->name('customer.orders');


        });

    
    });

        Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
            Route::post('/orders/{order}/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
            Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('order.delete'); // Tambah ini
            Route::post('/orders/{order}/ready', [OrderController::class, 'markAsReady'])->name('order.ready');

        });
        // Halaman Dashboard (Hanya bisa diakses setelah login & middleware customer)
        
        
    
    


require __DIR__.'/auth.php';
