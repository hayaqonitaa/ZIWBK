<!-- Add Tim Kerja Modal -->
<div class="modal fade" id="addContentTimKerja" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Add Tim Kerja</h3>
        </div>
        <form id="addContentTimKerjaForm" class="row g-3">
          <!-- Judul -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="judul">Judul</label>
            <input type="text" id="judul" name="judul" class="form-control" required />
          </div>
          
          <!-- Cabang -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="cabang">Cabang</label>
            <input type="text" id="cabang" name="cabang" class="form-control" required />
          </div>
          
          <!-- Bidang -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="bidang">Bidang</label>
            <input type="text" id="bidang" name="bidang" class="form-control" required />
          </div>
          
          <!-- ID SK -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="id_sk">ID SK</label>
            <input type="number" id="id_sk" name="id_sk" class="form-control" required />
          </div>
          
          <!-- File -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="file">File</label>
            <input type="file" id="file" name="file" class="form-control" accept=".pdf" required />
          </div>
          
          <!-- Status -->
          <div class="col-12 col-md-12">
            <label class="form-label" for="status">Status</label>
            <select id="status" name="status" class="form-select" required>
              <option value="" disabled selected>Pilih Status</option>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
          
          <!-- Submit and Cancel Buttons -->
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
