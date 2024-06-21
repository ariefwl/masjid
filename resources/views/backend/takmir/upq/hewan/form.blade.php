

<div class="modal fade" id="modalHewan" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formHewan" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-4 col-form-label">Hewan Qurban</label>
                  <div class="col-sm-8">
                    <input type="text" id="nama" name="nama" class="form-control">                            
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="jenis" class="col-4 col-form-label">Kategori</label>
                  <div class="col-sm-8">
                    {{-- <input type="text" id="kategori" name="kategori" class="form-control"> --}}
                    <select name="kategori" id="kategori" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item['id'] }}">{{ $item['nama_jenis'] }}</option>
                        @endforeach
                    </select>
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
                        {{-- <div class="preview"></div> --}}
                    </div>   
                </div>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>