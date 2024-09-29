<div class="modal fade" id="addProdi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">ADD PRODI</h3>
        </div>
        <form id="addProdiForm" class="row g-3" onsubmit="return false">
          <div class="col-12 col-md-12">
            <label class="form-label" for="nama">Nama Prodi</label>
            <input type="text" id="nama" name="nama" class="form-control" required/>
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label" for="jurusan">Jurusan</label>
            <select id="jurusan" name="jurusan" class="form-select" required>
              <option value="">Pilih Jurusan</option>
              <!-- Options akan diisi melalui JavaScript -->
            </select>
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
