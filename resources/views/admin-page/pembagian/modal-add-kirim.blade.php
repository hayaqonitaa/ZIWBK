<!-- Modal Konfirmasi Kirim -->
<div class="modal fade" id="sendModal" tabindex="-1" aria-labelledby="sendModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendModalLabel">Konfirmasi Pengiriman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin mengirim kuesioner untuk data yang dipilih?</p>
        <!-- Tambahkan ul untuk menampilkan daftar data yang dipilih -->
        <ul id="selectedDataList"></ul>
        <input type="hidden" id="selectedIds" name="selectedIds">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="confirmSend">Kirim</button>
      </div>
    </div>
  </div>
</div>
