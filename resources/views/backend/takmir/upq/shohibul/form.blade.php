<div class="modal fade" id="modalShohibul" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="frmShohibul">
            <div class="modal-body">
              <input type="hidden" name="status" id="status">
                <div class="row mb-3">
                  <label for="nama" class="col-sm-3 col-form-label">Shohibul Qurban</label>
                  <div class="col-sm-9">
                    <input type="text" id="nama" name="nama" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                  <div class="col-sm-9">
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="2"></textarea>
                  </div>
                </div>      
                <div class="row mb-3">
                  <label for="type" class="col-sm-3 col-form-label">Tujuan qurban</label>
                  <div class="col-sm-9">
                    <select name="type" id="type" class="form-select">
                      <option value="Sunnah">Sunnah</option>
                      <option value="Wajib">Wajib</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="alamat" class="col-sm-3 col-form-label">Permintaan</label>
                  <div class="col-sm-9">
                    <textarea name="permintaan" id="permintaan" class="form-control" cols="30" rows="2"></textarea>
                  </div>
                </div>                       
                <div class="row mb-3">
                  <label for="alamat" class="col-sm-3 col-form-label">Telepon</label>
                  <div class="col-sm-9">
                    <input type="text" id="telp" name="telp" class="form-control">
                  </div>
                </div>  
                <div class="row mb-3">
                  <label for="id_hewan" class="col-sm-3 col-form-label">Hewan Qurban</label>
                  <div class="col-sm-9">
                    <select name="id_hewan" id="id_hewan" class="form-select">
                        <option value="">-- Hewan Qurban --</option>
                        @foreach ($hewanQurban as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->nama_hewan }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" id="btnProses">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>