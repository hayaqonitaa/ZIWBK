<!-- Add Content Category Modal -->
<div class="modal fade" id="addContentLayananPengaduan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Add Content Layanan Pengaduan</h3>
        </div>
        <form id="addContentLayananPengaduanForm" class="row g-3">
          <div class="col-12 col-md-12">
            <label class="form-label" for="judul">Judul</label>
            <input type="text" id="judul" name="judul" class="form-control" required />
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label" for="deskripsi">Link</label>
            <input type="text" id="deskripsi" name="deskripsi" class="form-control" required />
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label" for="file">Logo</label>
            <input type="file" id="file" name="file" class="form-control" accept="image/*" required />
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label" for="status">Status</label>
            <select id="status" name="status" class="form-select" required>
              <option value="" disabled selected>Pilih Status</option>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
