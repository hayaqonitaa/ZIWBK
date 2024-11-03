<!-- Edit Prodi Modal -->
<div class="modal fade" id="editContentAgenPerubahan" tabindex="-1" aria-labelledby="editContentAgenPerubahanLabel" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editContentAgenPerubahanLabel">Edit Prodi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editContentAgenPerubahanForm">
          <input type="hidden" id="editContentAgenPerubahanId" name="id">
          
          <div class="mb-3">
            <label for="editJudul" class="form-label">Nama</label>
            <input type="text" class="form-control" id="editJudul" name="judul" required>
          </div>

          <div class="mb-3">
            <label for="editDeskripsi" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="editDeskripsi" name="deskripsi" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Foto saat ini: </label><br>
            <img id="currentFileImage" src="" alt="Current file" style="width: 80%; height: auto; display: none;">
          </div>

          <div class="mb-3">
            <label for="editFile" class="form-label">Foto</label>
            <input type="file" class="form-control" id="editFile" name="file">
          </div>

          <!-- <div class="mb-3">
            <label class="form-label">Status saat ini: </label>
            <span id="currentStatus" class="badge bg-info"></span>
          </div> -->

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
