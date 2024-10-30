<!-- Add Content Category Modal -->
<div class="modal fade" id="addContentCategories" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Add Content Category</h3>
        </div>
        <!-- Hapus onsubmit="return false" -->
        <form id="addContentCategoryForm" class="row g-3">
          <div class="col-12 col-md-12">
            <label class="form-label" for="nama">Nama Content Category</label>
            <input type="text" id="nama" name="nama" class="form-control" required />
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
