$(function () {
    // Saat tombol Kirim ditekan
    $('#showConfirmModalButton').on('click', function () {
        // Ambil mahasiswa yang dipilih
        var selectedIds = $('.row-checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        if (selectedIds.length === 0) {
            alert('Silakan pilih mahasiswa terlebih dahulu.');
            return;
        }

        // AJAX request untuk mengambil data kuesioner dan mahasiswa yang dipilih
        $.ajax({
            url: '/pembagian/getSelectedData', // URL ke endpoint backend untuk mendapatkan data mahasiswa & kuesioner
            type: 'POST',
            data: { mahasiswa_ids: selectedIds },
            success: function (response) {
                var tbody = $('#confirmSendTable tbody');
                tbody.empty(); // Kosongkan tabel sebelum menambahkan data baru

                // Loop untuk menambahkan data mahasiswa dan kuesioner ke tabel
                response.data.forEach(function (item, index) {
                    tbody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.mahasiswa.nim}</td>
                            <td>${item.mahasiswa.nama}</td>
                            <td>${item.kuesioner.judul}</td>
                        </tr>
                    `);
                });

                // Tampilkan modal konfirmasi
                $('#confirmSendModal').modal('show');
            },
            error: function (xhr) {
                alert('Terjadi kesalahan dalam mengambil data mahasiswa dan kuesioner.');
            }
        });
    });

    // Saat tombol konfirmasi Kirim ditekan di dalam modal
    $('#confirmSendButton').on('click', function () {
        // Ambil data form dan kirim kuesioner
        var selectedIds = $('.row-checkbox:checked').map(function () {
            return $(this).val();
        }).get();

        $.ajax({
            url: '/pembagian/share', // URL untuk melakukan pengiriman
            type: 'POST',
            data: { mahasiswa_ids: selectedIds },
            success: function (response) {
                alert('Kuesioner berhasil dikirim!');
                $('#confirmSendModal').modal('hide'); // Tutup modal setelah sukses
                location.reload(); // Reload halaman untuk memperbarui data
            },
            error: function (xhr) {
                alert('Terjadi kesalahan dalam pengiriman kuesioner.');
            }
        });
    });
});
