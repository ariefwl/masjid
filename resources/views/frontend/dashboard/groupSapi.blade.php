@extends('frontend.layout.layout')
@push('css')
    
@endpush

@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1><b>Daftar Kelompok Qurban Sapi</b></h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="row mb-2">
            <div class="col-lg-6 col-sm-12">
                <a href="{{ url('/') }}" type="button" class="btn btn-circle btn-sm btn-success">
                    <b> <i class="ri-logout-circle-line"></i> Kembali</b>
                </a>
            </div>
        </div>
        @foreach ($kelompok as $kel )
        <div class="card col-lg-3 col-md-4">
            <img src="{{ asset('Image/cow.png') }}" style="width: 100%; height: 200px; position: relative; overflow: hidden;" class="card-img-top mt-2" alt="{{ $kel->foto1 }}">
            {{-- <img src="{{ asset('Image/qurban/1445H/'.$kel->foto1) }}" style="width: 100%; height: 200px; position: relative; overflow: hidden;" class="card-img-top mt-2" alt="{{ $kel->foto1 }}"> --}}
            <div class="card-body">
                
              <h5 class="card-title">Kelompok {{ $kel->nama_hewan }}</h5>

              <strong>Shohibul Qurban:</strong>
              <ul>
                @foreach (explode(',', $kel->shohibul_names) as $nama)
                  <li>{{ $nama }}</li>
                @endforeach
              </ul>
            </div>
        </div>
        @endforeach
      </div>
    </section>

  </main><!-- End #main -->
@endsection

@push('js')
    
@endpush