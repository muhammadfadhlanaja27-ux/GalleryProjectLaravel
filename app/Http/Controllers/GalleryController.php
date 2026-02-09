<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Menampilkan SEMUA foto di halaman Gallery
    public function index()
    {
        // Ambil semua data tanpa batas 5
        $galleries = Gallery::latest()->get();

        // Pastikan return ke view 'gallery', bukan 'index'
        return view('gallery', compact('galleries'));
    }

    // Menampilkan detail satu foto
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('gallery-single', compact('gallery'));
    }
}