@extends('layouts.app')

@section('content')
  <section id="hero" class="hero section pt-5"
    style="position: relative; min-height: 100vh; background: black; overflow: hidden;">

    <div id="faulty-terminal-background" style="position: fixed; inset: 0; z-index: 0;"></div>

    <div class="container" style="position: relative; z-index: 1;">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center" style="color: white; padding-top: 100px;">

          <h2>
            Haiiii Ini Gallery Kamiiii
            <span id="split-text-root" data-text=""></span>
          </h2>

          <h3 class="mb-5">Fadhlan & Hanaa</h3>

          <div id="bounce-cards-root" data-images="{{ json_encode($imageUrls) }}"
            style="display: flex; justify-content: center; min-height: 400px;"></div>

          <div class="d-flex justify-content-center mt-5">
            <a href="{{ route('gallery') }}">
              <button class="btn-glow">LIHAT SEMUA FOTO</button>
            </a>
          </div>

        </div>
      </div>
    </div>
  </section>

  @viteReactRefresh
  @vite(['resources/js/app.jsx'])
@endsection