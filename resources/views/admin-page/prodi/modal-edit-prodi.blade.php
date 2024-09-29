
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
          <input type="hidden" id="editProdiId" name="id">
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama Prodi</label>
            <input type="text" class="form-control" id="editNama" name="nama" required>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
