<!-- Edit Piagam Modal -->
<div class="modal fade" id="editContentPiagam" tabindex="-1" aria-labelledby="editContentPiagamLabel" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editContentPiagamLabel">Edit Piagam</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editContentPiagamForm" enctype="multipart/form-data">
          <input type="hidden" id="editContentPiagamId" name="id">

          <div class="mb-3">
            <label for="editJudul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="editJudul" name="judul" required>
          </div>

          <div class="mb-3">
            <label for="editDeskripsi" class="form-label">Deskripsi</label>
            <textarea id="editDeskripsi" name="deskripsi" class="form-control" required></textarea>
          </div>

          <div class="mb-3">
            <label for="currentFileImage" class="form-label">Gambar saat ini:</label><br>
            <img id="currentFileImage" src="" alt="Current Image" style="width: 80%; height: auto; display: none;">
          </div>

          <div class="mb-3">
            <label for="editImage" class="form-label">Upload Gambar baru</label>
            <input type="file" class="form-control" id="editImage" name="file" accept="image/*">
          </div>

          <div class="mb-3">
            <label for="editStatus" class="form-label">Status</label>
            <select id="editStatus" name="status" class="form-select">
              <option value="" disabled selected>Pilih Status</option>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
