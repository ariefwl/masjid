@extends('backend.layout.layout');

@push('css')
    {{-- @vite(['resources/js/app.js', 'resources/css/app.css']) --}}
    @vite(['resources/js/app.js'])
@endpush

@section('judul', 'Panitia Qurban :: Al - Istiqomah')
    
@section('main')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard - {{ $unit; }}</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>

        {{-- {!! QrCode::size(400)->generate('Sistem Informasi Manajemen Yaisba'); !!} --}}
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- Saldo Kas Card -->
                    <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
        
                        {{-- <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
        
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div> --}}
        
                        <div class="card-body">
                            <h5 class="card-title">Saldo Kas <span>| Per tgl : {{ date('d-M-Y') }}</span></h5>
        
                            <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h5 id="saldoakhir"></h5>
                                <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
        
                            </div>
                            </div>
                        </div>
        
                        </div>
                    </div><!-- End Saldo Kas Card -->

                     <!-- Revenue Card -->
                     <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
        
                        {{-- <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
        
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div> --}}
        
                        <div class="card-body">
                            <h5 class="card-title">Pemasukan <span>| Per tgl : {{ date('d-M-Y') }}</span></h5>
        
                            <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h5 id="revenue"></h5>
                                <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
        
                            </div>
                            </div>
                        </div>
        
                        </div>
                    </div><!-- End Revenue Card -->

                     <!-- Expense Card -->
                     <div class="col-xxl-4 col-md-4">
                        <div class="card info-card sales-card">
        
                        {{-- <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
        
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div> --}}
        
                        <div class="card-body">
                            <h5 class="card-title">Pengeluaran <span>| Per tgl : {{ date('d-M-Y') }}</span></h5>
        
                            <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h5 id="expense"></h5>
                                <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
        
                            </div>
                            </div>
                        </div>
        
                        </div>
                    </div><!-- End Expense Card -->
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function(){
        getSaldoKasQurban();
        getRevenue();
        getExpense();
    })

    function getSaldoKasQurban()
    {
        $.ajax({
          url : "dashboard/getSaldoKasQurban",
          type : "GET",
          dataType : "JSON",          
          success : function(response){
            // console.log(response.data['saldo_akhir']);
            document.getElementById("saldoakhir").innerText = 'Rp. ' + formatPrice(response.data['saldo_akhir']);
          }
        })
    }

    function getRevenue()
    {
        $.ajax({
            url: 'dashboard/getRevenue',
            type : 'GET',
            dataType : 'JSON',
            success : function(response){
                // console.log(response.data);
                document.getElementById("revenue").innerText = 'Rp. ' + formatPrice(response.data);
            }
        })
    }

    function getExpense()
    {
        $.ajax({
            url: 'dashboard/getExpense',
            type : 'GET',
            dataType : 'JSON',
            success : function(response){
                // console.log(response.data);
                document.getElementById("expense").innerText = 'Rp. ' + formatPrice(response.data);
            }
        })
    }

    window.onload = function() {
        var channel = Echo.channel('channel-sakhir');
        channel.listen("SaldoAkhirKas", function(response) {
            document.getElementById("saldoakhir").innerText = 'Rp. ' + formatPrice(response.saldoAkhir);
            document.getElementById("revenue").innerText = 'Rp. ' + formatPrice(response.revenue);
            document.getElementById("expense").innerText = 'Rp. ' + formatPrice(response.expense);
        })
    }

    function formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }
    
</script>
@endpush

    