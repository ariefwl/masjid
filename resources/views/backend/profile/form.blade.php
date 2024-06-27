@extends('backend.layout.layout');

@push('css')
@endpush

@section('judul','Profile | Al - Istiqomah');

@section('main')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile Masjid</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>
    <div class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <h5 class="card-title">Data Masjid</h5>
                    </div>
                    <form id="formProfile" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="nama" class="col-form-label col-md-3">Nama Masjid</label>
                                <div class="col-md-9">
                                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $masjid[0]['nama'] }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="alamat" class="col-form-label col-md-3">Alamat</label>
                                <div class="col-md-9">
                                    <textarea name="alamat" id="alamat" cols="30" rows="4"
                                        class="form-control">{{ $masjid[0]['alamat'] }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="telepon" class="col-form-label col-md-3">No. Telepon</label>
                                <div class="col-md-9">
                                    <input type="text" name="telepon" id="telepon" class="form-control" value="{{ $masjid[0]['telepon'] }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-form-label col-md-3">E - Mail</label>
                                <div class="col-md-9">
                                    <input type="text" name="email" id="email" class="form-control" value="{{ $masjid[0]['email'] }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="logo" class="col-form-label col-md-3">Logo</label>
                                <div class="col-md-9">
                                    <input type="file" name="logo" id="logo" class="form-control">
                                    <img id="prev" name="prev" alt="" class="mt-2 img-thumbnail"
                                        style="max-width: 200px;">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="simpan" name="simpan" class="btn btn-md btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#formProfile').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            console.log(formData);
            $.ajax({
                url  : "{{ route('profiles.store') }}",
                type : "POST",
                data : formData,
                processData: false,
                contentType: false,
                dataType : 'json',
                success : function(response){

                }
            });
        })
    });

    document.getElementById('logo').onchange = function(evt) {
        var [file] = evt.target.files;
        if (file) {
            var preview = document.getElementById('prev');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    };

</script>
@endpush