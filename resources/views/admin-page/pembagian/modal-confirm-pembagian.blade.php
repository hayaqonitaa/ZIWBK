<!-- Modal Konfirmasi Pengiriman -->
<div class="modal fade" id="confirmSendModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">Konfirmasi Pengiriman Kuesioner</h3>
          <p>Pastikan data mahasiswa dan kuesioner yang akan dikirim sudah benar.</p>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered" id="confirmSendTable">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Judul Kuesioner</th>
              </tr>
            </thead>
            <tbody>
              <!-- Data will be populated via JavaScript -->
            </tbody>
          </table>
        </div>
        <div class="col-12 text-center mt-3">
          <button type="button" class="btn btn-primary" id="confirmSendButton">Kirim</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>
