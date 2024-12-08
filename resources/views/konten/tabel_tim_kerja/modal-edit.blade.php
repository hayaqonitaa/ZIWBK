<!-- Edit Tim Kerja Modal -->
<div class="modal fade" id="editContentTabelTimKerja" tabindex="-1" aria-labelledby="editContentTimKerjaLabel" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContentTabelTimKerjaLabel">Edit Tim Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editContentTabelTimKerjaForm">
                    <!-- Hidden input for ID -->
                    <input type="hidden" id="editContentTabelTimKerjaId" name="id">

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
                    </div>

                    <!-- NIP -->
                    <div class="mb-3">
                        <label for="editNip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="editNip" name="nip" required>
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label for="editJabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="editJabatan" name="jabatan" required>
                    </div>

                    <!-- Surat Keputusan (SK) Dropdown -->
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="sk">Surat Keputusan (SK)</label>
                        <select id="editSk" name="id_sk" class="form-select">
                            <option value="" disabled selected>Pilih Surat Keputusan</option>
                            <!-- Options will be dynamically added via JS -->
                        </select>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
