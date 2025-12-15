<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminGameController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MidtransController; // <--- PENTING: Tambahkan ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES ---
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- AUTHENTICATION ROUTES ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// --- MIDTRANS CALLBACK (WAJIB DI LUAR AUTH) ---
// Rute ini diakses oleh server Midtrans untuk update status pembayaran
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);

// --- MEMBER ROUTES (Wajib Login) ---
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/member/dashboard', [MemberController::class, 'index'])->name('member.dashboard');

    // Proses Topup
    Route::get('/topup/{slug}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/topup/process', [OrderController::class, 'process'])->name('order.process');

    // Pembayaran
    Route::get('/payment/{invoice}', [OrderController::class, 'showPayment'])->name('payment.show');
    Route::get('/payment/success', [OrderController::class, 'success'])->name('payment.success');
});

// --- ADMIN ROUTES (Wajib Login & Role Admin) ---
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
    
    // Game & Item
    Route::resource('admin/games', AdminGameController::class);
    Route::post('admin/games/{game}/items', [AdminGameController::class, 'storeItem'])->name('games.items.store');
    Route::delete('admin/items/{item}', [AdminGameController::class, 'destroyItem'])->name('items.destroy');
    
    // Transaksi
    Route::get('admin/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::put('admin/transactions/{transaction}', [AdminTransactionController::class, 'updateStatus'])->name('transactions.update');
});

