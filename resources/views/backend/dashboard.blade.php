@extends('backend.layout.layout');

@push('css')
    {{-- @vite(['resources/js/app.js', 'resources/css/app.css']) --}}
    @vite(['resources/js/app.js'])
@endpush

@section('judul', (Auth()->user()->unit == 3) ? 'Panitia Qurban' : 'Panitia Zakat ' . ':: Al - Istiqomah')
    
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
            @if (Auth()->user()->unit == 3)
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
            @else
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Zakat Uang Card -->
                        <div class="col-xxl-3 col-md-3">
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
                                <h5 class="card-title">Zakat <span>| Uang</span></h5>

                                <div class="d-flex align-items-center">
                                {{-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div> --}}
                                <div class="ps-3">
                                    <h6 id="zuang" name="zuang"></h6>
                                    <span class="text-success large pt-1 fw-bold">Hari ini :</span> <span class="text-muted large pt-2 ps-1" id="zuangNow"></span>
                                </div>
                                </div>
                            </div>

                            </div>
                        </div><!-- End Zakat Card -->

                        <!-- Zakat Beras Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Zakat <span>| Beras</span></h5>

                                <div class="d-flex align-items-center">
                                {{-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div> --}}
                                <div class="ps-3">
                                    <h6 id="zberas" name="zberas"></h6>
                                    <span class="text-success large pt-1 fw-bold">Hari ini :</span> <span class="text-muted large pt-2 ps-1" id="zberasNow"></span>

                                </div>
                                </div>
                            </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Mal Uang Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Mal <span>| Uang</span></h5>

                                <div class="d-flex align-items-center">
                                {{-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div> --}}
                                <div class="ps-3">
                                    <h6 id="muang"></h6>
                                    <span class="text-success large pt-1 fw-bold">Hari ini :</span> <span class="text-muted large pt-2 ps-1" id="muangNow"></span>

                                </div>
                                </div>
                            </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Sodaqoh Beras Card -->
                        {{-- <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Sodaqoh <span>| Beras</span></h5>

                                <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>$3,264</h6>
                                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div><!-- End Revenue Card --> --}}

                        <!-- Infaq Uang Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Infaq <span>| Uang</span></h5>

                                <div class="d-flex align-items-center">
                                {{-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div> --}}
                                <div class="ps-3">
                                    <h6 id="iuang"></h6>
                                    <span class="text-success large pt-1 fw-bold">Hari ini :</span> <span class="text-muted large pt-2 ps-1" id="iuangNow"></span>

                                </div>
                                </div>
                            </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Sodaqoh Uang Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Sodaqoh <span>| Uang</span></h5>

                                <div class="d-flex align-items-center">
                                {{-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div> --}}
                                <div class="ps-3">
                                    <h6 id="suang"></h6>
                                    <span class="text-success large pt-1 fw-bold">Hari ini :</span> <span class="text-muted large pt-2 ps-1" id="suangNow"></span>

                                </div>
                                </div>
                            </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Total Pemasukan Uang Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Pemasukan <span>| Uang</span></h5>

                                <div class="d-flex align-items-center">
                                {{-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div> --}}
                                <div class="ps-3">
                                    <h6 id="totUang"></h6>
                                    <span class="text-success large pt-1 fw-bold">Hari ini :</span> <span class="text-muted large pt-2 ps-1" id="totUangNow"></span>

                                </div>
                                </div>
                            </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Total Pemasukan Beras Card -->
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Pemasukan <span>| Beras</span></h5>

                                <div class="d-flex align-items-center">
                                {{-- <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div> --}}
                                <div class="ps-3">
                                    <h6 id="totBeras"></h6>
                                    <span class="text-success large pt-1 fw-bold">Hari ini :</span> <span class="text-muted large pt-2 ps-1" id="totBerasNow"></span>

                                </div>
                                </div>
                            </div>

                            </div>
                        </div><!-- End Revenue Card -->
                    </div>
                </div>
            @endif
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

    