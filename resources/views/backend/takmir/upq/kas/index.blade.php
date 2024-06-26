@extends('backend.layout.layout');

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('judul', 'Kas Qurban | Al - Istiqomah');

@section('main')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Kas Qurban</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Kas Qurban</li>
            </ol>
        </nav>
        <div class="message ms-auto"></div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <h5 class="card-title">Data Kas Qurban</h5>
                        <button onclick="add()" class="btn btn-circle btn-sm btn-primary mt-0">
                            <b><i class="ri-add-fill"></i> Tambah Data</b>
                        </button>
                        <h3 class="card-title">Saldo Akhir Kas : Rp. 5.000.000</h3>
                    </div>
                    <div class="card-body">
                        <table id="tblKas" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Pemasukan</th>
                                    <th>Pengeluaran</th>
                                    <th>Di input oleh</th>
                                    <th>Proses</th>
                                </tr>
                            </thead>
                        </table>
                        <tbody></tbody>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @includeIf('backend.takmir.upq.kas.form')
</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
<script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.currency').inputmask({
            'alias': 'numeric',
            'prefix' : 'Rp. ',
            'digits': 0,
            'groupSeparator': ',',
            'autoGroup' : true,
            'digitsOptional': false,
            'removeMaskOnSubmit': true,
            'autoUnmask': true
        });

        let tabel = $('#tblKas').DataTable({
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
                { data : 'DT_RowIndex'},
                { data : 'tanggal'},
                { data : 'kategori'},
                { data : 'keterangan'},
                { data : 'pemasukan'},
                { data : 'pengeluaran'},
                { data : 'nama'},
                { data : 'button'},
            ],
            lengthChange: false,
        })

        $('#formKas').on('submit', function(e){
            e.preventDefault();
            
            var $type = $('#status').val() === 'edit' ? 'put' : 'post';
            var $msg = $('#status').val() === 'edit' ? 'Data Kas berhasil di Update !' : 'Data kas berhasil ditambahkan !';
            var $data = {
                            'tanggal' : $('#tanggal').val(),
                            'kategori' : $('#kategori').val(),
                            'keterangan' : $('#keterangan').val(), 
                            'jenis' : $("input[type='radio'][name='jenis']:checked").val(), 
                            'jumlah' : $('#jumlah').val(),
                        };
            
                        $.ajax({
                            url : $('#frmKas').attr('action'),
                            type: $type,
                            data: $data,                        
                            dataType: 'json',
                            success: function(data){
                                if (data.msg == 'tglOffSide') {
                                    showAlert('danger', 'Tanggal transaksi Off Side !');
                                    $('#modalKas').modal('hide');
                                    tabel.ajax.reload();
                                } else {
                                    if (data.msg == 'gagal') {
                                        showAlert('danger', 'Saldo kas tidak cukup !');
                                        $('#modalKas').modal('hide');
                                        tabel.ajax.reload();
                                    } else {
                                        showAlert('success', $msg);
                                        $('#modalKas').modal('hide');
                                        tabel.ajax.reload();
                                    }
                                }
                            },
                            error: function(data){
                                showAlert('danger', 'Data gagal di simpan !');
                                $('#modalKas').modal('hide');
                                tabel.ajax.reload();
                            }
                        })
        })

        $("#tanggal").flatpickr({
            dateFormat: "d-m-Y",
        });
    }); 

    function add(url)
    {
        // alert(url);
        $('#modalKas').modal('show');
        $('#modalKas .modal-title').html('<b>Tambah Data Kas</b>');
        $('#formKas')[0].reset();
        $('#formKas').attr('action', url);
        $('#btnProses').html('Simpan');
        $('#formKas [name=_method]').val('post');
    }

    function edit(url)
    {
        // alert(url);
        $('#modalKas').modal('show');
        $('#modalKas .modal-title').html('<b>Edit Data Kas</b>');
        $('#formKas')[0].reset();
        $('#formKas').attr('action', url);
        $.get(url)
            .done((response) => {
                console.log(Date('d-m-Y', response.tanggal));
                $('#tanggal').val(response.tanggal);
                $('#kategori').val(response.kategori);
                $('#keterangan').val(response.keterangan);
                $('#jumlah').val(response.jumlah);
                $('#status').val('edit');
                $('#btnProses').html('Update');
            })
            .fail((errors) => {
                alert('Tidak ada data !');
                console.error('Error:', errors);
            });
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

    function number(e)
    {
        var charCode = (e.which) ? e.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
@endpush