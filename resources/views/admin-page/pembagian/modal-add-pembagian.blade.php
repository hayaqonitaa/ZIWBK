<div class="modal fade" id="shareQuestionnaireModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Bagikan Kuesioner</h3>
        </div>
        <form id="shareQuestionnaireForm" class="row g-3" onsubmit="return false">
          <div class="col-12">
            <label class="form-label" for="questionnaireSelect">Pilih Kuesioner</label>
            <select id="questionnaireSelect" name="questionnaire_id" class="form-select" required>
              <option value="">Pilih Kuesioner</option>
              <!-- Options will be populated via AJAX -->
            </select>
          </div>

          <input type="hidden" id="selectedNIM" name="nim" value=""> <!-- Menyimpan NIM mahasiswa yang dipilih -->

          <div class="col-12">
            <label class="form-label">Mahasiswa Terpilih</label>
            <input type="text" class="form-control" id="selectedMahasiswa" value="" readonly>
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Kirim</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
