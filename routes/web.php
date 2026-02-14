<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan; // WAJIB ADA BIAR GAK ERROR 500
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\GalleryController as AdminGallery;
use App\Models\Gallery;

// --- HALAMAN DEPAN ---
Route::get('/', function () {
    // Ambil semua data gallery biar tampil di landing page
    $galleries = Gallery::latest()->get();
    
    // Langsung arahkan ke view 'index' dengan variabel yang konsisten
    return view('index', compact('galleries'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Rute ini arahkan ke controller yang kodenya udah kita benerin tadi
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.single');

// --- HALAMAN ADMIN (DASHBOARD) ---
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/gallery', [AdminGallery::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [AdminGallery::class, 'create'])->name('gallery.create');
    Route::post('/gallery/store', [AdminGallery::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{id}/edit', [AdminGallery::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{id}', [AdminGallery::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{id}', [AdminGallery::class, 'destroy'])->name('gallery.destroy');
});

// Jalankan ini di browser: url-web-lu.com/clear
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Semua sampah cache berhasil dibuang!";
});