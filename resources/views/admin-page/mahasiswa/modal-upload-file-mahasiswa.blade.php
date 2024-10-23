<!-- Modal for uploading Excel -->
<div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">

      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Upload Mahasiswa Excel</h3>
        </div>
        <form id="uploadExcelForm" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="file" class="form-label">Pilih File Excel</label>
            <input type="file" class="form-control" id="file" name="file" accept=".xls,.xlsx" required>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Upload</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
