<!-- Edit Tim Kerja Modal -->
<div class="modal fade" id="editContentTimKerja" tabindex="-1" aria-labelledby="editContentTimKerjaLabel" aria-hidden="true">
    <div class="modal-dialog modal-simple modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContentTimKerjaLabel">Edit Tim Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editContentTimKerjaForm">
                    <input type="hidden" id="editContentTimKerjaId" name="id">
                    
                    <div class="mb-3">
                        <label for="editJudul" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editJudul" name="judul" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Saat Ini:</label><br>
                        <a id="currentPdfFileLink" href="" target="_blank" style="display: none;"></a>
                    </div>

                    <div class="mb-3">
                        <label for="editFile" class="form-label">Upload File Baru (PDF)</label>
                        <input type="file" class="form-control" id="editFile" name="file" accept=".pdf">
                    </div>

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
