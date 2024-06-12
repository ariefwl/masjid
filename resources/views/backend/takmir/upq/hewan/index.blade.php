@extends('backend.layout.layout');

@push('css')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css"> --}}
{{-- <link rel="stylesheet" href="{{ asset('Backend/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('Backend/vendor/datatables-responsive/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/vendor/datatables-responsive/css/responsive.bootstrap4.css') }}"> --}}
@endpush

@section('judul', 'Hewan Qurban | Al - Istiqomah');

@section('main')
    <main id="main" >
        <div class="pagetitle">
            <h1>Hewan Qurban</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Master Data</li>
                </ol>
            </nav>
        </div>
        <div class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar Hewan Qurban</h5>
                            <div class="row mb-2">
                                <div class="col-sm-12 col-md-6">
                                    <button type="button" class="btn btn-circle btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                                        <b><i class="ri-add-fill"></i> Tambah Data</b>
                                    </button>
                                </div>
                            </div>

                            <table id="tbl_hewan" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Hewan Qurban</th>
                                        <th>Jenis</th>
                                        <th>Umur</th>
                                        <th>Bobot</th>
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
                  <h5 class="modal-title"><b>Tambah Hewan Qurban</b></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('penerima.store') }}" enctype="multipart/form-data">
                  @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                          <label for="inputText" class="col-sm-4 col-form-label">Hewan Qurban</label>
                          <div class="col-sm-8">
                            <input type="text" id="nama" name="nama" class="form-control">                            
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="jenis" class="col-4 col-form-label">Jenis</label>
                          <div class="col-sm-8">
                            <input type="text" id="jenis" name="jenis" class="form-control">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="umur" class="col-4 col-form-label">Umur</label>
                          <div class="col-sm-8">
                            <input type="number" id="umur" name="umur" class="form-control">
                          </div>
                        </div>                    
                        <div class="row mb-3">
                          <label for="alamat" class="col-4 col-form-label">Bobot</label>
                          <div class="col-sm-8">
                              <input type="number" class="form-control" id="bobot" name="bobot">
                          </div>
                        </div>     
                        <div class="row mb-3">
                            <label for="foto" class="col-4 col-form-label">Foto</label> 
                            <div class="col-sm-8">
                                <input type="file" name="gbr" id="gbr" class="form-control">
                                <img id="prev" name="prev" alt="" class="mt-2 img-thumbnail" style="max-width: 100px;">    
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
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>

{{-- <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script> --}}

{{-- <script src="{{ asset('Backend/vendor/datatables-responsive/js/jquery-1.12.3.js') }}"></script> --}}
{{-- <script src="{{ asset('Backend/vendor/datatables-responsive/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('Backend/vendor/datatables-responsive/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('Backend/vendor/datatables-responsive/js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('Backend/vendor/datatables-responsive/js/responsive.bootstrap4.js') }}"></script> --}}
<script type="text/javascript">
    $(document).ready(function(){
        table = $('#tbl_hewan').DataTable({
            fixHeader: true,
            responsive : true,
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
                // data : function(data){
                    // data.jenis = 
                // }
            },
            columns: [
                { data: 'DT_RowIndex'},
                { data: 'nama_hewan'},
                { data: 'jenis'},
                { data: 'umur'},
                { data: 'bobot'},
                { data: 'button'}
            ],
            lengthChange: false
        })
    })

    document.getElementById('gbr').onchange = function (evt) {
            var [file] = evt.target.files;
            if (file) {
                var preview = document.getElementById('prev');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        };
</script>
@endpush