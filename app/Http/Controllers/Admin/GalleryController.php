<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // 1. LIHAT DAFTAR FOTO
    public function index() {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create() {
        return view('admin.gallery.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'image' => 'required|image|max:10240',
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil ditambah!');
    }

    // 2. EDIT FOTO
    public function edit($id) {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id) {
        $gallery = Gallery::findOrFail($id);
        
        $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'image' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image); // Hapus foto lama
            $gallery->image = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil diperbarui!');
    }

    // 3. HAPUS FOTO
    public function destroy($id) {
        $gallery = Gallery::findOrFail($id);
        Storage::disk('public')->delete($gallery->image); // Hapus file fisiknya
        $gallery->delete(); // Hapus datanya di database

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil dihapus!');
    }
}