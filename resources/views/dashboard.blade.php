@extends('layout.layout');

@section('judul', 'Dashboard UPQ | Al - Istiqomah')
    
@section('main')
<main id="main" class="main">
    <div class="pagetitle">
        <?php $user = Auth::user()->unit; ?>
        <h1>Dashboard -  {{ ($user == '3')?'Unit Pengelola Qurban':'Unit Pengelola Zakat' }}</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
</main>

    