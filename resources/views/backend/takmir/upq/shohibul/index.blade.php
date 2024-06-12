@extends('backend.layout.layout');

@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('Backend/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> --}}


    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">

@endpush

@section('judul', 'Shohibul Qurban | Al - Istiqomah');

@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Daftar Shohibul Qurban</h1>
            <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                  <li class="breadcrumb-item active">Master Data</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Shohibul Qurban</h5>
                            <div class="row mb-2">
                                <div class="col-lg-6 col-sm-12">
                                    <button type="button" class="btn btn-circle btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                                        <b> <i class="ri-add-fill"></i> Tambah Data</b>
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                {{-- <div class="row mb-2">
                                    <div class="col-lg-6 col-sm-12">
                                        <a href="{{ url('/') }}" type="button" class="btn btn-circle btn-sm btn-success">
                                            <b> <i class="ri-logout-circle-line"></i> Kembali</b>
                                        </a>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text">Filter Jenis Qurban</span>
                                        <select class="form-select" name="jenis" id="jenis">                                    
                                            <option value="all">-- Semua Jenis --</option>
                                            <?php foreach ($jenis as $key) { ?>
                                              <option value="{{ $key['id'] }}">{{ $key['nama_jenis'] }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text">Filter Kelompok Sapi</span>
                                        <select disabled class="form-select" name="kelompok" id="kelompok">                                    
                                            <option value="all">-- Semua Kelompok --</option>
                                            <?php foreach ($kelompokSapi as $key) { ?>
                                              <option value="{{ $key['id'] }}">Kelompok {{ $key['nama_hewan'] }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <table id="tbl_shohibul" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Shohibul</th>
                                        <th>Alamat</th>
                                        <th>No. Telepon</th>
                                        {{-- <th>Jenis Qurban</th> --}}
                                        <th>Proses</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><b>Tambah Data Shohibul Qurban</b></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('shohibul.store') }}">
                  @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                          <label for="nama" class="col-4 col-form-label">Shohibul Qurban</label>
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
                          <label for="alamat" class="col-4 col-form-label">Telepon</label>
                          <div class="col-sm-8">
                            <input type="text" id="telp" name="telp" class="form-control">
                          </div>
                        </div>  
                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Hewan Qurban</label>
                          <div class="col-sm-8">
                            <select name="id_klp" id="id_klp" class="form-select">
                                <option value="">-- Hewan Qurban --</option>
                                @foreach ($hewanQurban as $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->nama_hewan }}</option>
                                @endforeach
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
            table = $('#tbl_shohibul').DataTable({
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
                        data.jenis = $('#jenis').val();
                        data.kelompok = $('#kelompok').val();
                    }
                },
                columns: [
                    { data : 'DT_RowIndex', name : 'DT_RowIndex'},
                    { data : 'nama', name : 'nama'},
                    { data : 'alamat', name : 'alamat'},
                    { data : 'telp', name : 'telp'},
                    // { data : 'jenis', name : 'jenis'},
                    { data : 'button', name : 'button'}
                ],
                lengthChange: false,
            })

            $('#jenis').on('change', function(){
                if($('#jenis').val() == 1){
                document.getElementById("kelompok").disabled=false;
                }else{
                document.getElementById("kelompok").disabled=true;
                }
                table.ajax.reload(); 
            })

            $('#kelompok').on('change', function(){
                // alert($('#kelompok').val());
                table.ajax.reload(); 
            })

            $('#test').on('click', function(){
                alert('test');
            })
            
        })

    </script>
@endpush
