@extends('backend.layout.layout');

@push('css')
    
@endpush

@section('judul', 'Zakat :: Al - Istiqomah')

@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Zakat Infaq & Sodaqoh</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Zakat</li>
                </ol>
            </nav>

            <button id="tmbhData" class="btn btn-circle btn-primary btn-sm" style="font-weight: 600;"><b>Tambah Data</b></button>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rekapitulasi Z.I.S</h5>
                            
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-text">Periode :</span>
                                        <input type="text" class="form-control datepicker" autocomplete="off" name="tgl_awal" id="tgl_awal">
                                        <span class="input-group-text">s/d</span>
                                        <input type="text" class="form-control datepicker" autocomplete="off" name="tgl_akhir" id="tgl_akhir">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <button class="btn btn-primary btn-md" id="filter">Filter</button>
                                        {{-- <a href="{{ ('zakat/export_excel') }}" class="btn btn-success btn-md">Export Xls</a> --}}
                                        <button class="btn btn-success btn-md" id="export">Export Xls</button>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row d-flex col-md-12 mb-4">
                                <label for="" class="col-form-label col-md-1">Periode :</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control datepicker" autocomplete="off" name="tgl_awal" id="tgl_awal">
                                </div>
                                <label for="" class="col-form-label col-md-1">s/d</label>
                                <div class="col-md-3">
                                    <input type="text" class="form-control datepicker" autocomplete="off" name="tgl_akhir" id="tgl_akhir">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-circle btn-success btn-sm" id="filter">Filter</button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('zakat.export') }}" class="btn btn-circle btn-success btn-sm">Export Xls</a>
                                </div>
                            </div> --}}


                            <table id="tbl_zis" class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;" rowspan="2">No.</th>
                                        <th style="text-align: center;" rowspan="2">Muzaki</th>
                                        <th style="text-align: center;" rowspan="2">Jiwa</th>
                                        <th style="text-align: center;" colspan="2" data-dt-order="disable">Zakat</th>
                                        <th style="text-align: center;" colspan="2" data-dt-order="disable">Infaq</th>
                                        <th style="text-align: center;" colspan="2" data-dt-order="disable">Sodaqoh</th>
                                        <th style="text-align: center;" data-dt-order="disable">Mal</th>
                                        <th style="text-align: center;" data-dt-order="disable">Fidyah</th>
                                        <th style="text-align: center;" rowspan="2" data-dt-order="disable">Proses</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center;">Beras</th>
                                        <th style="text-align: center;">Uang</th>
                                        <th style="text-align: center;">Beras</th>
                                        <th style="text-align: center;">Uang</th>
                                        <th style="text-align: center;">Beras</th>
                                        <th style="text-align: center;">Uang</th>
                                        <th style="text-align: center;">Uang</th>
                                        <th style="text-align: center;">Uang</th>
                                    </tr>
                                </thead>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('js')
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#tmbhData').on('click', function(){
                $.ajax({
                    url : '{{ url('zakat') }}',
                    type : 'GET',
                    success : function(response){
                        
                    }
                })
            });
        })
    </script>
@endpush