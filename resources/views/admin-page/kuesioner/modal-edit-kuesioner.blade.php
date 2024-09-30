<!-- Edit Kuesioner Modal -->
<div class="modal fade" id="editKuesioner" tabindex="-1" aria-labelledby="editKuesionerLabel" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editKuesionerLabel">Edit Kuesioner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editKuesionerForm">
          <input type="hidden" id="editKuesionerId" name="id"> <!-- ID hidden field -->
          <div class="mb-3">
            <label for="editJudul" class="form-label">Judul Kuesioner</label>
            <input type="text" class="form-control" id="editJudul" name="judul" required>
          </div>
          <div class="mb-3">
            <label for="editLink" class="form-label">Link Kuesioner</label>
            <input type="text" class="form-control" id="editLink" name="link_kuesioner" required>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
