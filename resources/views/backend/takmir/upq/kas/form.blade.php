<div class="modal fade" id="modalKas" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formKas">
          @csrf
          @method('PUT')
            <div class="modal-body">
                <h5>Saldo Kas : {{ formatRupiah($saldoAkhir) }}</h5>
                <input type="hidden" name="status" id="status">
                <div class="row mb-3">
                  <label for="tgl" class="col-sm-4 col-form-label">Tanggal</label>
                  <div class="col-sm-8">
                    {{-- <input type="date" id="tanggal" name="tanggal" class="form-control">                             --}}
                    <input type="text" id="tanggal" name="tanggal" class="form-control datepicker">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="kategori" class="col-4 col-form-label">Kategori</label>
                  <div class="col-sm-8">
                    <input name="kategori" id="kategori" class="form-control"></input>
                  </div>
                </div>                    
                <div class="row mb-3">
                  <label for="jenis" class="col-4 col-form-label">Jenis</label>
                  <div class="col-sm-8">
                      {{-- <input type="text" class="form-control" id="jenis" name="jenis"> --}}
                      <div id='jenis'>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis" id="masuk" value="masuk" checked>
                            <label class="form-check-label" for="masuk">
                              Pemasukan
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis" id="keluar" value="keluar">
                            <label class="form-check-label" for="keluar">
                              Pengeluaran
                            </label>
                          </div>
                      </div>
                  </div>
                </div>                      
                <div class="row mb-3">
                  <label for="jumlah" class="col-4 col-form-label">Jumlah</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control currency" id="jumlah" name="jumlah" onkeypress="return number(event)">
                  </div>
                </div>                     
                <div class="row mb-3">
                  <label for="jenis" class="col-4 col-form-label">Keterangan</label>
                  <div class="col-sm-8">
                      <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"></textarea>
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