<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>YAISBA | Al - Istiqomah</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('Backend/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('Backend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('Backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
  <link href="{{ asset('Backend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('Backend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('Backend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  {{-- <link href="{{ asset('Backend/vendor/simple-datatables/style.css') }}" rel="stylesheet"> --}}

  <!-- Template Main CSS File -->
  <link href="{{ asset('Backend/css/style.css') }}" rel="stylesheet">
</head>

<body class="toggle-sidebar">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Al - Istiqomah</span>
      </a>
    </div>
  </header><!-- End Header -->

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
                                    <select class="form-select" name="jenis" id="jenis">                                    
                                        <option value="all">-- Semua Kelompok --</option>
                                        
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
                                    <td colspan="3"><span style="color: blue">* Biru : warga non muslim</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Al - Istiqomah {{ date('Y') }}</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
  {{-- <script src="{{ asset('Backend/vendor/simple-datatables/simple-datatables.js') }}"></script> --}}

  <!-- Template Main JS File -->
  <script src="{{ asset('Backend/js/main.js') }}"></script>

  <script type="text/javascript">
        $(document).ready(function(){
            table = $('#tbl_penerima').DataTable({
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
        })
  </script>

</body>

</html>