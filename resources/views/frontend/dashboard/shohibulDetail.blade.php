@extends('frontend.layout.layout')

@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
    {{-- <link rel="stylesheet" href="{{ asset('Backend/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> --}}
@endpush

@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1><b>Daftar Shohibul Qurban</b></h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="row mb-2">
                            <div class="col-lg-6 col-sm-12">
                                <a href="{{ url('/') }}" type="button" class="btn btn-circle btn-sm btn-success">
                                    <b> <i class="ri-logout-circle-line"></i> Kembali</b>
                                </a>
                            </div>
                        </div>
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
                                    <?php foreach ($kelompok as $key) { ?>
                                      <option value="{{ $key['id'] }}">Kelompok {{ $key['nama_hewan'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- <table id="tbl_shohibul" class="table table-bordered table-striped"> --}}
                    <table id="tbl_shohibul" class="display nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Shohibul Qurban</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <td colspan="4" style="font-style: italic; color: red"><span>* Bila ada kesalahan dalam penulisan identitas, mohon untuk menghubungi panitia</span></td>
                          </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection

@push('js')
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  {{-- <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script> --}}
  {{-- <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script> --}}
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>


  <script type="text/javascript">
        $(document).ready(function(){
           table = $('#tbl_shohibul').DataTable({
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
                ],
                lengthChange: false,
            });
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
            table.ajax.reload(); 
        })
  </script>
@endpush