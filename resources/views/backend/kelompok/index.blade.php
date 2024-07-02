@extends('backend.layout.layout');

@push('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('Backend/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('judul', 'Kelompok | Al - Istiqomah');

@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Kelompok</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Master Data</li>
              </ol>
            </nav>
            <button onclick="add()" class="btn btn-circle btn-sm btn-primary mb-2">
                <b>Tambah Data</b>
            </button>
            <div class="message ms-auto"></div>
            {{-- <a href="{{ url('kelompok/create') }}" class="btn btn-circle btn-primary btn-sm" style="font-weight: 600;"><b>Tambah Data</b></a> --}}
        </div>

        <div class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Kelompok</h5>
                            <table id="tbl_kelompok" class="table table-bordered table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kelompok</th>
                                        <th>Nama Koordinator</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Proses</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@includeIf('backend.kelompok.form')
    </main>
@endsection

@push('js')

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="{{ asset('Backend/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> --}}
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            table = $('#tbl_kelompok').DataTable({
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
                    url : '{{ url()->current() }}'
                },
                columns: [
                    { data : 'DT_RowIndex', name : 'DT_RowIndex'},
                    { data : 'kelompok', name : 'kelompok'},
                    { data : 'koordinator', name : 'koordinator'},
                    { data : 'alamat', name : 'alamat'},
                    { data : 'telp', name : 'telp'},
                    { data : 'button', name : 'button'}
                ]
            })

            $('#frmKlp').on('submit', function (e) {
                let $type = $('#status').val() === 'edit' ? 'put' : 'post';
                let $msg = $('#status').val() === 'edit' ? 'Data kelompok berhasil di Update !' : 'Data kelompok berhasil ditambahkan !';
                if (! e.preventDefault()){
                    $.ajax({
                        url : $('#frmKlp').attr('action'),
                        type: $type,
                        data: {
                          'kelompok' : $('#kelompok').val(),
                          'koordinator' : $('#koordinator').val(),
                          'telepon' : $('#telp').val(),
                          'alamat' : $('#alamat').val() 
                        },                        
                        dataType: 'json',
                        success: function(data){
                            showAlert('success', $msg);
                            $('#modalKlp').modal('hide');
                            table.ajax.reload();
                        },
                        error: function(data){
                            alert('Data gagal di simpan !');
                            return;
                        }
                    })
                }
            })
        })

        function add(url)
        {
            $('#modalKlp').modal('show');
            $('#modalKlp .modal-title').html('<b>Tambah Data Kelompok</b>');
            
            $('#frmKlp')[0].reset();
            $('#frmKlp').attr('action', url);
            $('#frmKlp [name=_method]').val('post');
            // $('#kelompok').focus();
        }

        function edit(url)
        {
            // alert(url);
            $('#modalKlp').modal('show');
            $('#modalKlp .modal-title').html('<b>Edit Data Kelompok</b>');
            $('#frmKlp')[0].reset();
            $('#frmKlp').attr('action', url);
            // $('#frmKlp [name=_method]').val('PUT');

            $.get(url)
                .done((response) => {
                    $('#kelompok').val(response.kelompok);
                    $('#koordinator').val(response.koordinator);
                    $('#alamat').val(response.alamat);
                    $('#telp').val(response.telp);
                    $('#status').val('edit');
                    $('#btnProses').html('Update');
                })
                .fail((errors) => {
                    alert('Tidak ada data !');
                })
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