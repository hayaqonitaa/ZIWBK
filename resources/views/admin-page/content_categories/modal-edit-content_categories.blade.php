<!-- Edit Content Category Modal -->
<div class="modal fade" id="editContentCategory" tabindex="-1" aria-labelledby="editContentCategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editContentCategoryLabel">Edit Content Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editContentCategoryForm">
          <input type="hidden" id="editContentCategoryId" name="id"> <!-- ID hidden field -->
          <div class="mb-3">
            <label for="editNama" class="form-label">Nama Content Category</label>
            <input type="text" class="form-control" id="editNama" name="nama" required>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
