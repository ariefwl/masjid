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
            <button type="button" class="btn btn-circle btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                <b>Tambah Data</b>
              </button>
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

        <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><b>Tambah Data Kelompok</b></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('kelompok') }}" method="POST">
                  @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Kelompok</label>
                          <div class="col-sm-8">
                            <input type="text" id="klmpk" name="klmpk" class="form-control">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="koor" class="col-4 col-form-label">Nama Koordinator</label>
                          <div class="col-sm-8">
                            <input type="text" id="koor" name="koor" class="form-control">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="alamat" class="col-4 col-form-label">Alamat</label>
                          <div class="col-sm-8">
                            <input type="text" id="alamat" name="alamat" class="form-control">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="telp" class="col-4 col-form-label">Telepon</label>
                          <div class="col-sm-8">
                            <input type="text" id="telp" name="telp" class="form-control">
                          </div>
                        </div>                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
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
            $('#tbl_kelompok').DataTable({
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
        })
    </script>
@endpush