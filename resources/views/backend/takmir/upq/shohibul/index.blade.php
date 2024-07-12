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
            <div class="message ms-auto"></div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Shohibul Qurban</h5>
                            <div class="row mb-2">
                                <div class="col-lg-6 col-sm-12">
                                    <button onclick="add()" class="btn btn-circle btn-sm btn-primary">
                                        <b> <i class="ri-add-fill"></i> Tambah Data</b>
                                    </button>
                                    <a href="{{ route('shohibul.create') }}" target="_blank" class="btn btn-circle btn-sm btn-success">
                                        <b> <i class="bi bi-printer"></i> Cetak TT</b>
                                    </a>
                                    <a href="{{ route('cetakUndangan') }}" class="btn btn-circle btn-sm btn-warning">
                                        <b> <i class="bi bi-file-earmark-excel"></i> Cetak Undangan</b>
                                    </a>
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
                                <div class="col-md-6">
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
                                <div class="col-md-6">
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

                            <table id="tbl_shohibul" class="{{ config('app.table_style') }}" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Shohibul</th>
                                        <th>Alamat</th>
                                        <th>No. Telepon</th>
                                        <th>Tujuan Qurban</th>
                                        <th>Permintaan</th>
                                        <th>Proses</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@includeIf('backend.takmir.upq.shohibul.form')
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                    { data : 'type', name : 'type'},
                    { data : 'permintaan', name : 'permintaan'},
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
            
            $('#frmShohibul').on('submit', function (e) {
                e.preventDefault();

                var $type = $('#status').val() === 'edit' ? 'put' : 'post';
                var $msg = $('#status').val() === 'edit' ? 'Data shohibul berhasil di Update !' : 'Data shohibul berhasil ditambahkan !';
                var $data = {
                        'nama' : $('#nama').val(),
                        'alamat' : $('#alamat').val(),
                        'type' : $('#type').val(), 
                        'permintaan' : $('#permintaan').val(), 
                        'telepon' : $('#telp').val(),
                        'id_hewan' : $('#id_hewan').val()
                    };

                $.ajax({
                    url : $('#frmShohibul').attr('action'),
                    type: $type,
                    data: $data,                        
                    dataType: 'json',
                    success: function(data){
                        showAlert('success', $msg);
                        $('#modalShohibul').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(data){
                        showAlert('danger', 'Data gagal di simpan !');
                        return;
                    }
                })
            });
        })

        function add(url)
        {
            $('#modalShohibul').modal('show');
            $('#modalShohibul .modal-title').html('<b>Tambah Data Shohibul</b>');
            $('#frmShohibul')[0].reset();
            $('#frmShohibul').attr('action', url);
            $('#btnProses').html('Simpan');
            $('#frmShohibul [name=_method]').val('post');
        }

        function edit(url)
        {
            $('#modalShohibul').modal('show');
            $('#modalShohibul .modal-title').html('<b>Edit Data Shohibul</b>');

            $('#frmShohibul')[0].reset();
            $('#frmShohibul').attr('action', url);

            $.get(url)
                .done((response) => {
                    $('#nama').val(response.nama);
                    $('#alamat').val(response.alamat);
                    $('#id_hewan').val(response.id_hewan);
                    $('#type').val(response.type);
                    $('#telp').val(response.telp);
                    $('#permintaan').val(response.permintaan);
                    $('#status').val('edit');
                    $('#btnProses').html('Update');
                })
                .fail((errors) => {
                    alert('Tidak ada data !');
                    console.error('Error:', errors);
                });
        }

        function cetak(url)
        {
            // console.log(url);
            // let newWindow = window.open('', '_blank');
            // newWindow.location.href = {{ route('shohibul.create') }};
        }

        function showAlert(type, message)
        {
            var alert = '<div class="alert alert-'+type+' alert-dismissible fade show" role="alert">'
                        +message+
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            $('.message').html(alert);
            setTimeout(() => {
                $('.message').alert('close');
            }, 5000);  
        }
    </script>
@endpush
