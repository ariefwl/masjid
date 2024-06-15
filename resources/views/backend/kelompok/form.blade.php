
<div class="modal fade" id="modalKlp" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="frmKlp">
          {{-- @csrf --}}
          {{-- @method('post') --}}
            <div class="modal-body">
              {{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> --}}
              <input type="hidden" name="idKlp" id="idKlp">
              <div class="row mb-3">
                <label for="inputText" class="col-sm-4 col-form-label">Kelompok</label>
                <div class="col-sm-8">
                    <input type="hidden" name="status" id="status">
                    <input type="text" id="kelompok" name="kelompok" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="koor" class="col-4 col-form-label">Nama Koordinator</label>
                  <div class="col-sm-8">
                    <input type="text" id="koordinator" name="koordinator" class="form-control">
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
                <button class="btn btn-primary" id="btnProses">Simpan</button>
            </div>
        </form>
      </div>
    </div>
</div>