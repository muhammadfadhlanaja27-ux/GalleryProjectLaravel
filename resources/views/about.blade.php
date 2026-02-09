@extends('layouts.app')

@section('title', 'About')
@section('body_class', 'about-page')

@section('content')
  <div id="faulty-terminal-background" style="position: fixed; inset: 0; z-index: 0;"></div>

  <div style="position: relative; z-index: 1;">
    
    <div class="page-title" data-aos="fade" style="background: transparent;">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 style="color: white;">About</h1>
              <p class="mb-0" style="color: rgba(255,255,255,0.7);">Odio et unde deleniti. Deserunt numquam exercitationem. Jam sit omnis eius dolores.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">About</li>
          </ol>
        </div>
      </nav>
    </div>

    <section id="about" class="about section" style="background: transparent;">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4 justify-content-center">
          <div class="col-lg-4">
            <img src="{{ asset('assets/img/profile-img.jpg') }}" class="img-fluid" alt="" style="border-radius: 15px; border: 2px solid rgba(239, 158, 239, 0.3);">
          </div>
          
          <div class="col-lg-5 content" style="background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(10px); padding: 30px; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.1); color: white;">
            <h2 style="color: #ef9eef;">Professional Photographer from New York</h2>
            <p class="fst-italic py-3">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul style="list-style: none; padding: 0;">
                  <li class="mb-2"><i class="bi bi-chevron-right" style="color: #ef9eef;"></i> <strong>Birthday:</strong> <span>1 May 1995</span></li>
                  <li class="mb-2"><i class="bi bi-chevron-right" style="color: #ef9eef;"></i> <strong>Website:</strong> <span>www.example.com</span></li>
                  <li class="mb-2"><i class="bi bi-chevron-right" style="color: #ef9eef;"></i> <strong>Phone:</strong> <span>+123 456 7890</span></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul style="list-style: none; padding: 0;">
                  <li class="mb-2"><i class="bi bi-chevron-right" style="color: #ef9eef;"></i> <strong>Age:</strong> <span>30</span></li>
                  <li class="mb-2"><i class="bi bi-chevron-right" style="color: #ef9eef;"></i> <strong>Degree:</strong> <span>Master</span></li>
                  <li class="mb-2"><i class="bi bi-chevron-right" style="color: #ef9eef;"></i> <strong>Freelance:</strong> <span>Available</span></li>
                </ul>
              </div>
            </div>
            <p class="py-3">
              Officiis eligendi itaque labore et dolorum mollitia officiis optio vero.
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>

  <style>
    body.about-page { background-color: #000; }
    .breadcrumbs ol li a, .breadcrumbs ol li.current { color: white !important; }
    /* Memperbaiki warna icon chevron */
    .content ul li i { font-weight: bold; }
  </style>

  @viteReactRefresh
  @vite(['resources/js/app.jsx'])
@endsection