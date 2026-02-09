@extends('layouts.app')

{{-- Judul mengikuti nama foto dari database --}}
@section('title', 'Gallery - ' . $gallery->title)

@section('body_class', 'gallery-single-page')

@section('content')
  <div id="faulty-terminal-background" style="position: fixed; inset: 0; z-index: 0;"></div>

  <div style="position: relative; z-index: 1;">
    
    <div class="page-title" data-aos="fade" style="background: transparent;">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 style="color: white;">{{ $gallery->title }}</h1>
              <p class="mb-0" style="color: rgba(255,255,255,0.7);">{{ $gallery->description ?? 'Tidak ada deskripsi untuk foto ini.' }}</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Gallery Single</li>
          </ol>
        </div>
      </nav>
    </div>

    <section id="gallery-details" class="gallery-details section" style="background: transparent;">
      <div class="container" data-aos="fade-up">

        <div class="portfolio-details-slider swiper init-swiper" style="border-radius: 15px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1);">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide text-center">
              {{-- Ambil Gambar dari Storage --}}
              <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" style="max-height: 70vh; width: auto; object-fit: contain;">
            </div>
          </div>
        </div>

        <div class="row justify-content-between gy-4 mt-4">
          <div class="col-lg-8">
            {{-- BOX DESKRIPSI DENGAN EFEK BLUR --}}
            <div class="portfolio-description" style="background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(10px); padding: 30px; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.1); color: white;">
              <h2 style="color: #ef9eef;">Detail Foto: {{ $gallery->title }}</h2>
              <p>
                {{ $gallery->description }}
              </p>
            </div>
          </div>

          <div class="col-lg-3">
            {{-- BOX INFO DENGAN EFEK BLUR --}}
            <div class="portfolio-info" style="background: rgba(239, 158, 239, 0.1); backdrop-filter: blur(10px); padding: 30px; border-radius: 20px; border: 1px solid rgba(239, 158, 239, 0.3); color: white;">
              <h3 style="color: white; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px;">Project information</h3>
              <ul style="list-style: none; padding: 0;">
                <li class="mb-2"><strong>Category:</strong> <span style="color: #ef9eef;">{{ $gallery->category }}</span></li>
                <li class="mb-2"><strong>Client:</strong> <span>Internal Photography</span></li>
                <li class="mb-2"><strong>Project date:</strong> <span>{{ $gallery->created_at->format('d M, Y') }}</span></li>
                <li class="mb-2"><strong>Project URL:</strong> <a href="#" style="color: #ef9eef;">N/A</a></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>

  <style>
    body.gallery-single-page { background-color: #000; }
    .breadcrumbs ol li a, .breadcrumbs ol li.current { color: white !important; }
    .portfolio-info strong { color: #ef9eef; }
  </style>

  {{-- Inisialisasi React --}}
  @viteReactRefresh
  @vite(['resources/js/app.jsx'])
@endsection