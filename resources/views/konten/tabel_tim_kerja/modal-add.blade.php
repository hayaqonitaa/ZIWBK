<!-- Add Content Tim Kerja Modal -->
<div class="modal fade" id="addContentTabelTimKerja" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Tambah Tim Kerja</h3>
        </div>
        <form id="addContentTabelTimKerjaForm" class="row g-3">
          <!-- Nama -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" required />
          </div>
          <!-- NIP -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="nip">NIP</label>
            <input type="text" id="nip" name="nip" class="form-control" required />
          </div>
          <!-- Jabatan -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="jabatan">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" class="form-control" required />
          </div>
          <!-- ID SK -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="sk">Surat Keputusan (SK)</label>
            <select id="sk" name="id_sk" class="form-select" required>
              <option value="" disabled selected>Pilih Surat Keputusan</option>
            </select>
          </div>

          <!-- <div class="col-12 col-md-12">
            <label class="form-label" for="jabatan">Surat Keputusan (SK)</label>
            <input type="text"  id="id_sk" name="id_sk" class="form-control" required />
          </div> -->

          
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
