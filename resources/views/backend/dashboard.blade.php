@extends('backend.layout.layout');

@section('judul', 'Dashboard Takmir | Al - Istiqomah')
    
@section('main')
<main id="main" class="main">
    <div class="pagetitle">
        <?php $user = Auth::user()->unit; ?>
        <h1>Dashboard -  {{ ($user == '3')?'Takmir':'Unit Pengelola Zakat' }}</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>

        {{-- {!! QrCode::size(400)->generate('Sistem Informasi Manajemen Yaisba'); !!} --}}
    </div><!-- End Page Title -->
</main>
@endsection

    