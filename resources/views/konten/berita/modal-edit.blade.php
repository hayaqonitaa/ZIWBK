<!-- Edit Content Berita Modal -->
<div class="modal fade" id="editContentBerita" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Edit Berita</h3>
        </div>
        <form id="editContentBeritaForm" class="row g-3" enctype="multipart/form-data">
          <!-- Hidden input for ID -->
          <input type="hidden" id="editContentBeritaId" name="id" />

          <!-- Judul -->
          <div class="col-12">
            <label class="form-label" for="editJudul">Judul</label>
            <input type="text" id="editJudul" name="judul" class="form-control" required />
          </div>

          <!-- Deskripsi -->
          <div class="col-12">
            <label class="form-label" for="editDeskripsi">Deskripsi</label>
            <textarea id="editDeskripsi" name="deskripsi" class="form-control" rows="3" required></textarea>
          </div>

          <!-- Gambar -->
          <div class="col-12">
            <label class="form-label" for="editFile">Gambar</label>
            <input type="file" id="editFile" name="file" class="form-control" accept="image/*" />
            <small id="editFileHelp" class="form-text text-muted">Biarkan kosong jika tidak mengubah gambar.</small>
            <div class="mt-2">
              <strong>File saat ini:</strong>
              <span id="currentFile" class="text-muted">Tidak ada file</span>
              <img id="currentFileImage" src="" alt="Preview Gambar" class="img-thumbnail mt-2" style="display: none; max-height: 150px;" />
            </div>
          </div>

          <!-- Link Berita -->
          <div class="col-12">
            <label class="form-label" for="editLink">Link Berita</label>
            <input type="url" id="editLink" name="link" class="form-control" required />
          </div>

          <!-- Status -->
          <div class="col-12">
            <label class="form-label" for="editStatus">Status</label>
            <select id="editStatus" name="status" class="form-select" required>
              <option value="" disabled selected>Pilih Status</option>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
            <small id="currentStatusHelp" class="form-text text-muted">Status saat ini: <span id="currentStatus" class="fw-bold text-primary"></span></small>
          </div>

          <!-- Submit & Cancel Buttons -->
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
