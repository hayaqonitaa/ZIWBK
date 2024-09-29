
<!-- Edit Jurusan Modal -->
<div class="modal fade" id="editJurusan" tabindex="-1" aria-labelledby="editJurusanLabel" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editJurusanLabel">Edit Jurusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editJurusanForm">
          <input type="hidden" id="editJurusanId" name="id">
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama Jurusan</label>
            <input type="text" class="form-control" id="editNama" name="nama" required>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
