<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Models\User;
use Illuminate\Http\Request;

// Halaman Login & Register
Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => $request->password,
        'role' => 'siswa'
    ]);
    return redirect('/')->with('success', 'Akun berhasil dibuat! Silakan login.');
});

Route::post('/login', function (Request $request) {
    $user = User::where('username', $request->username)
                ->where('password', $request->password)
                ->first();

    if ($user) {
        session(['user_id' => $user->id, 'role' => $user->role, 'username' => $user->username]);
        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/siswa/dashboard');
        }
    }
    return redirect()->back()->with('error', 'Username atau password salah!');
});

// Route Siswa
Route::middleware([])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/menu/{id}', [SiswaController::class, 'detailMenu'])->name('siswa.detail');
    Route::get('/siswa/keranjang', [SiswaController::class, 'keranjang'])->name('siswa.keranjang');
    Route::post('/siswa/keranjang/tambah/{id}', [SiswaController::class, 'tambahKeranjang'])->name('siswa.keranjang.tambah');
    Route::post('/siswa/keranjang/update/{id}', [SiswaController::class, 'updateKeranjang'])->name('siswa.keranjang.update');
    Route::post('/siswa/checkout', [SiswaController::class, 'checkout'])->name('siswa.checkout');
    Route::get('/siswa/transaksi', [SiswaController::class, 'transaksi'])->name('siswa.transaksi');
    Route::get('/siswa/profil', [SiswaController::class, 'profil'])->name('siswa.profil');
});

// Route Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::post('/admin/menu/tambah', [AdminController::class, 'storeMenu']);
Route::post('/admin/pesanan/status/{id}', [AdminController::class, 'updateStatus']);

// Logout
Route::get('/logout', function() {
    session()->flush();
    return redirect('/');
});