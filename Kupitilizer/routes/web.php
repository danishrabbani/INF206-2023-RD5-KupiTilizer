<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestJemputController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KurirController;
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
    return view('home', ['nama', 'dina']);
})->name('home');

Route::get('/aboutus', function(){
    return view('aboutus');
})->name('aboutus');

Route::get('/statuspembelian', function(){
    return view('statuspembelian');
})->name('statuspembelian');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/setting', [ProfileController::class, 'setting']);

    // Request Jemput
    Route::get('/requestjemput', function () {
        return view('requestPenjemputan');
    });
    Route::post('/requestjemput/create', [RequestJemputController::class, 'create'])->name('penjemputan.create');

    // Pembelian
    Route::get('/market', function () {
        return view('market');
    });

    // Coupon
    Route::get('/coupon', function () {
        return view('coupon');
    });

    Route::middleware(['user-access:admin'])->group(function () {
        // Dashboard
        Route::get('/admin', [AdminController::class, 'adminDashboard']);

        // Request Jemput
        Route::get('/admin/requestjemput', [RequestJemputController::class, 'index']);
        Route::get('/admin/requestjemput/detail/{id}', [RequestJemputController::class, 'detail']);
        Route::get('/admin/requestjemput/accept/{id}', [RequestJemputController::class, 'acceptRequest']);
        Route::get('/admin/requestjemput/done/{id}', [RequestJemputController::class, 'doneRequest']);

        // Pembelian
        Route::get('/admin/pembelian', [PembelianController::class, 'index']);

        // Product
        Route::get('/admin/product', [ProductController::class, 'index']);
        Route::get('/admin/product/manageproduct', [ProductController::class, 'manageProduct']);
        Route::get('/admin/product/addproduct', [ProductController::class, 'addProduct']);


        // Coupon
        Route::get('/admin/coupon', [CouponController::class, 'index']);

        /** 
         * Halaman Manage Akun
        */
        // User
        Route::get('/admin/manageuser', [UserController::class, 'manageUser']);
        Route::post('/admin/manageuser', [UserController::class, 'add'])->name('user.add');
        Route::delete('/admin/manageuser/delete/{email}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/admin/manageuser/edit/{email}', [UserController::class, 'show']);
        Route::patch('/admin/manageuser/update/{email}', [UserController::class, 'update']);

        Route::get('/admin/managekurir', [KurirController::class, 'manageKurir']);
    });

    Route::middleware(['user-access:manager'])->group(function () {
        // Dashboard
        Route::get('/manager', [ManagerController::class, 'managerDashboard']);

        // Request Jemput
        Route::get('/manager/requestjemput', [RequestJemputController::class, 'index']);
        Route::get('/manager/requestjemput/detail/{id}', [RequestJemputController::class, 'detail']);
        Route::get('/manager/requestjemput/accept/{id}', [RequestJemputController::class, 'acceptRequest']);
        Route::get('/manager/requestjemput/done/{id}', [RequestJemputController::class, 'doneRequest']);

        // Pembelian
        Route::get('/manager/pembelian', [PembelianController::class, 'index']);

        // Product
        Route::get('/manager/product', [ProductController::class, 'index']);
        Route::get('/manager/product/manageproduct', [ProductController::class, 'manageProduct']);
        Route::get('/manager/product/addproduct', [ProductController::class, 'addProduct']);
        
        // Coupon
        Route::get('/manager/coupon', [CouponController::class, 'index']);

        /** 
         * Halaman Manage Akun
        */
        // User
        Route::get('/manager/manageuser', [UserController::class, 'manageUser']);
        Route::post('/manager/manageuser', [UserController::class, 'add'])->name('user.add');
        Route::delete('/manager/manageuser/delete/{email}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/manager/manageuser/edit/{email}', [UserController::class, 'show']);
        Route::patch('/manager/manageuser/update/{email}', [UserController::class, 'update']);

        // Admin
        Route::get('/manager/manageadmin', [AdminController::class, 'manageAdmin']);
        Route::post('/manager/addadmin', [AdminController::class, 'addAdmin'])->name('manager.addadmin');
        Route::delete('/manager/manageadmin/delete/{email}', [AdminController::class, 'destroy'])->name('user.destroy');
        Route::get('/manager/manageadmin/edit/{email}', [AdminController::class, 'show']);
        Route::patch('/manager/manageadmin/update/{email}', [AdminController::class, 'update']);

        // Kurir
        Route::get('/manager/managekurir', [KurirController::class, 'manageKurir']);
        Route::post('/manager/managekurir', [KurirController::class, 'add'])->name('user.add');
        Route::delete('/manager/managekurir/delete/{email}', [KurirController::class, 'destroy'])->name('user.destroy');
        Route::get('/manager/managekurir/edit/{email}', [KurirController::class, 'show']);
        Route::patch('/manager/managekurir/update/{email}', [KurirController::class, 'update']);
    });

    Route::middleware(['user-access:user'])->group(function () {
        Route::get('/user', [UserController::class, 'userHome']);
        Route::get('/statuspermintaan', [UserController::class, 'userRequest']);
        
    });

    Route::middleware(['user-access:kurir'])->group(function () {
        Route::get('/kurir', [KurirController::class, 'dashboard']);

        // Request Jemput
        Route::get('/kurir/requestjemput', [KurirController::class, 'requestJemput']);
        Route::get('/kurir/requestjemput/detail/{id}', [KurirController::class, 'detail']);
        Route::get('/kurir/requestjemput/accept/{id}', [KurirController::class, 'acceptRequest']);
        Route::get('/kurir/requestjemput/cancel/{id}', [KurirController::class, 'cancelRequest']);
    });
});

require __DIR__.'/auth.php';
