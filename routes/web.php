<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\GalleryController as AdminGallery;
use App\Models\Gallery;

Route::get('/', function () {
    // 1. Ambil 5 foto terbaru
    $galleries = Gallery::latest()->take(5)->get();

    // 2. TRANSFORMASI: Ubah path database menjadi URL publik yang bisa dibaca React
    $imageUrls = $galleries->map(function($item) {
        return asset('storage/' . $item->image);
    });

    // 3. Kirim $imageUrls ke view index
    return view('index', compact('imageUrls'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

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

// Tambahin ini sementara di web.php buat reset
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache cleared!";
});