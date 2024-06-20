@extends('backend.layout.layout');

@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('Backend/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
@endpush

@section('judul', 'Penerima Qurban | Al - Istiqomah');

@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Daftar Penerima Qurban</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Master Data</li>
              </ol>
            </nav>
            {{-- <a href="{{ url('kelompok/create') }}" class="btn btn-circle btn-primary btn-sm" style="font-weight: 600;"><b>Tambah Data</b></a> --}}
        </div>

        <div class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Penerima Qurban</h5>
                            <div class="row mb-2">
                                <div class="col-sm-12 col-md-6">
                                    <button type="button" class="btn btn-circle btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                                        <b> <i class="ri-add-fill"></i> Tambah Data</b>
                                    </button>

                                    {{-- <button type="button" name="export" id="export" class="btn btn-circle btn-sm btn-success">
                                        <b><i class="ri-file-excel-2-line"></i> Export Xls</b>
                                    </button> --}}
                                </div>
                            </div>
                            <div class="row">

                                @if (session('success'))
                                    <div class="alert alert-success col-md-4">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                <div class="col-md-6">
                                    <form action="{{ route('exportExcel') }}" method="get">
                                        <div class="input-group">
                                            <span class="input-group-text">Filter data</span>
                                            <select class="form-select" name="kelompok" id="kelompok">                                    
                                                <option value="all">Semua Kelompok</option>
                                                @foreach ($kelompok as $key => $item)
                                                <option value="{{ $item }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-success btn-sm btn-circle"><b><i class="ri-file-excel-2-line"></i> Export Xls</b></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <form action="{{ route('importData') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                            <input class="form-control" type="file" name="file" id="file">
                                            <button class="btn btn-sm btn-warning" type="submit"><b>Upload</b></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <table id="tbl_penerima" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        {{-- <th>Kelompok</th> --}}
                                        <th>Nama Jamaah</th>
                                        <th>Alamat</th>
                                        <th>Proses</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><b>Tambah Data Penerima</b></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('penerima.store') }}">
                  @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Kelompok</label>
                          <div class="col-sm-8">
                            {{-- <input type="text" id="klmpk" name="klmpk" class="form-control"> --}}
                            <select name="id_klp" id="id_klp" class="form-select">
                                <option value="">-- Pilih Kelompok --</option>
                                @foreach ($kelompok as $key => $item)
                                    <option value="{{ $item }}">{{ $key }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="koor" class="col-4 col-form-label">Nama Penerima</label>
                          <div class="col-sm-8">
                            <input type="text" id="nama" name="nama" class="form-control">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="alamat" class="col-4 col-form-label">Alamat</label>
                          <div class="col-sm-8">
                            <input type="text" id="alamat" name="alamat" class="form-control">
                          </div>
                        </div>                    
                        <div class="row mb-3">
                          <label for="alamat" class="col-4 col-form-label">Type</label>
                          <div class="col-sm-8">
                            <select class="form-select" name="type" id="type">
                                <option value="1">Muslim</option>
                                <option value="0">Non Muslim</option>
                            </select>
                          </div>
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" id="simpan">Simpan</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    </main>
@endsection

@push('js')

    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            table = $('#tbl_penerima').DataTable({
                fixHeader: true,
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: true,
                language: {
                    lengthMenu: 'Display _MENU_ records per page',
                    zeroRecords: 'Nothing found - sorry',
                    info: 'Showing page _PAGE_ of _PAGES_',
                    infoEmpty: 'No records available',
                    infoFiltered: '(filtered from _MAX_ total records)'
                },
                ajax: {
                    url : '{{ url()->current() }}',
                    data : function(data){
                        data.kelompok = $('#kelompok').val();
                    }
                },
                columns: [
                    { data : 'DT_RowIndex', name : 'DT_RowIndex'},
                    // { data : 'id_klp', name : 'id_klp'},
                    { data : 'nama', name : 'nama'},
                    { data : 'alamat', name : 'alamat'},
                    { data : 'button', name : 'button'}
                ],
                lengthChange: false,
            })
        })

        $("#kelompok").change(function () {
            table.ajax.reload();
            // alert($('#kelompok').val());
        });

        $(document).on('click','#test', function(){
            $('.modal').modal('show');
        })

        $('.modal').validator().on('submit', function(e){
            if (! e.preventDefault()) {
                $.ajax({
                    type : 'POST',
                    // url  : <?php route('penerima.store')?>,
                    data : $('.modal').serialize(),
                })
                .done((response) => {
                    $('.modal').modal('hide');
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Data gagal di simpan !');
                    return;
                })
            }
        })

        // $(document).on('click','#export', function(){
        //     let klp = $('#kelompok').val();
        //     $.ajax({
        //         url : 'penerima/exportExcel',
        //         type : 'GET',
        //         data : {
        //             'kelompok' : klp 
        //         },
        //         success : function(){
                    
        //         }
        //     })
        // })
    </script>
@endpush