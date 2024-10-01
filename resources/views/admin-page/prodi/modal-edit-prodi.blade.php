<!-- Edit Prodi Modal -->
<div class="modal fade" id="editProdi" tabindex="-1" aria-labelledby="editProdiLabel" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProdiLabel">Edit Prodi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editProdiForm">
          <!-- Hidden input for Prodi ID -->
          <input type="hidden" id="editProdiId" name="id">
          
          <!-- Nama Prodi -->
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama Prodi</label>
            <input type="text" class="form-control" id="editNama" name="nama" required>
          </div>
          
          <!-- Jurusan dropdown -->
          <div class="mb-3">
            <label class="form-label" for="editJurusan">Jurusan</label>
            <select id="editJurusan" name="id_jurusan" class="form-select" required>
              <option value="">Pilih Jurusan</option>
              <!-- Options will be populated via JavaScript -->
            </select>
          </div>

          <!-- Submit & Cancel buttons -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
