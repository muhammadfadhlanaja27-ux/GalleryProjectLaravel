@extends('layouts.app')

@section('title', 'Gallery - PhotoFolio')

@section('body_class', 'gallery-page')

@section('content')
  <div id="faulty-terminal-background" style="position: fixed; inset: 0; z-index: 0;"></div>

  <div style="position: relative; z-index: 1;">

    <div class="page-title" data-aos="fade" style="background: transparent;">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 style="color: white;">Gallery</h1>
              <p class="mb-0" style="color: rgba(255,255,255,0.7);">Koleksi foto terbaik kami dalam satu galeri.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Gallery</li>
          </ol>
        </div>
      </nav>
    </div>

    <section id="gallery" class="gallery section" style="background: transparent;">
      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 justify-content-center">

          @forelse($galleries as $gallery)
            <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="gallery-item h-100"
                style="background: rgba(255,255,255,0.05); backdrop-filter: blur(5px); border-radius: 12px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); transition: 0.3s;">

                <div style="width: 100%; aspect-ratio: 1 / 1; overflow: hidden; position: relative;">
                  <img src="{{ asset('storage/' . $gallery->image) }}" class="img-fluid" alt="{{ $gallery->title }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
                </div>

                <div class="gallery-links d-flex align-items-center justify-content-center">
                  <a href="{{ asset('storage/' . $gallery->image) }}" title="{{ $gallery->title }}"
                    class="glightbox preview-link">
                    <i class="bi bi-arrows-angle-expand"></i>
                  </a>
                  <a href="{{ route('gallery.single', $gallery->id) }}" class="details-link">
                    <i class="bi bi-link-45deg"></i>
                  </a>
                </div>

              </div>
            </div>
          @empty
            <div class="col-12 text-center">
              <p style="color: white; font-style: italic;">Belum ada foto yang diunggah ke galeri.</p>
            </div>
          @endforelse

        </div>
      </div>
    </section>

  </div>

  <style>
    body.gallery-page {
      background-color: #000;
    }

    /* Navigasi Breadcrumbs agar terlihat di background gelap */
    .breadcrumbs ol li a,
    .breadcrumbs ol li.current {
      color: rgba(255, 255, 255, 0.8) !important;
    }

    /* Efek Hover pada Item Galeri */
    .gallery-item:hover {
      border-color: #ef9eef !important;
      /* Warna pink sesuai FaultyTerminal */
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(239, 158, 239, 0.2);
    }

    /* Memastikan container gambar tetap square di browser lama */
    @supports not (aspect-ratio: 1/1) {
      .gallery-item>div:first-child {
        padding-top: 100%;
        position: relative;
      }

      .gallery-item img {
        position: absolute;
        top: 0;
        left: 0;
      }
    }
  </style>

  @viteReactRefresh
  @vite(['resources/js/app.jsx'])
@endsection