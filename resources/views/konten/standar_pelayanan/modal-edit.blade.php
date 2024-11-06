<div class="modal fade" id="editContentStandarPelayanan" tabindex="-1" aria-labelledby="editContentStandarPelayananLabel" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editContentStandarPelayananLabel">Edit Standar Pelayanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editContentStandarPelayananForm" enctype="multipart/form-data">
          <input type="hidden" id="editContentStandarPelayananId" name="id">
          
          <div class="mb-3">
            <label for="editJudul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="editJudul" name="judul" required>
          </div>

          <div class="mb-3">
            <label for="currentPdf" class="form-label">PDF saat ini:</label><br>
            <span id="currentPdfLink" style="display: none;"></span>
            <a id="currentPdf" href="#" target="_blank" style="display: none;">Lihat PDF</a>
          </div>

          <div class="mb-3">
            <label for="editPdf" class="form-label">Upload PDF baru</label>
            <input type="file" class="form-control" id="editPdf" name="pdf" accept=".pdf">
          </div>

          <div class="mb-3">
            <label for="currentImage" class="form-label">Gambar saat ini:</label><br>
            <img id="currentImage" src="" alt="Current Image" style="width: 80%; height: auto; display: none;">
          </div>

          <div class="mb-3">
            <label for="editImage" class="form-label">Upload Gambar baru</label>
            <input type="file" class="form-control" id="editImage" name="gambar" accept="image/*">
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