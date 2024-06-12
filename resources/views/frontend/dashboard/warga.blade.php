@extends('frontend.layout.layout')

@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('Backend/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
@endpush

@section('main')
    <main id="main" class="main">

    <div class="pagetitle">
        <h1><b>Daftar Penerima Qurban</b></h1>
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
                                    <span class="input-group-text">Filter Per Kelompok</span>
                                    <select class="form-select" name="kelompok" id="kelompok">                                    
                                        <option value="all">-- Semua Kelompok --</option>
                                        @foreach ($kelompok as $item)
                                            <option value="{{ $item->id }}">{{ $item->kelompok }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="tbl_penerima" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Warga</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="3"><span style="color: blue">* Warga non muslim</span></td>
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
            table = $('#tbl_penerima').DataTable({
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
                    { data : 'DT_RowIndex'},
                    { data : 'nama'},
                    { data : 'alamat'}
                ],
                lengthChange: false,
                rowCallback: function(row, data, index){
                    if(data.type == 1){
                        $(row).find('td:eq(1)').css('color', 'blue');
                    }
                }
            })

            $('#kelompok').on('change',function(){
                table.ajax.reload();
            })
        })
    </script>
@endpush
