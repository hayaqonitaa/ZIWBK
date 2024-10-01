
<!-- Edit Mahasiswa Modal -->
<div class="modal fade" id="editMahasiswa" tabindex="-1" aria-labelledby="editMahasiswaLabel" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMahasiswaLabel">Edit Mahasiswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editMahasiswaForm">
          <input type="hidden" id="editMahasiswaId" name="id">
          <div class="mb-3">
            <label for="editNim" class="form-label">NIM</label>
            <input type="text" class="form-control" id="editNimMhs" name="nim" required>
            </div>

            <div class="mb-3">
            <label for="editNama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="editNama" name="nama" required>
            </div>

            <div class="mb-3">
            <label class="form-label" for="prodi">Prodi</label>
            <select id="editProdi" name="id_prodi" class="form-select" required>
                <option value="" disabled selected>Pilih Prodi</option>
                <!-- Options akan diisi dari database melalui JavaScript -->
            </select>
            </div>  

            <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" name="email" required>
            </div>

          <button type="submit" class="btn btn-primary">Update</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
