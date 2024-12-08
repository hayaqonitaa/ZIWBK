$(document).on('click', '.edit-btn', function () {
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var nip = $(this).data('nip');
    var jabatan = $(this).data('jabatan');

    // Isi data ke modal
    $('#editContentTabelTimKerjaId').val(id);
    $('#editNama').val(nama);
    $('#editNip').val(nip);
    $('#editJabatan').val(jabatan);

    // Ambil data Surat Keputusan (SK) untuk mengisi dropdown
    $.ajax({
        url: '/content/tim_kerja/data',  // Sesuaikan dengan URL yang mengembalikan data SK
        type: 'GET',
        success: function (data) {
            console.log(data); // Cek apakah data muncul di console
            var skSelect = $('#editSk');
            skSelect.empty();  // Kosongkan dropdown sebelumnya
            skSelect.append('<option value="" disabled selected>Pilih Surat Keputusan</option>');  // Tambahkan opsi default

            // Loop melalui data dan masukkan pilihan ke dropdown
            data.data.forEach(function (item) {
                skSelect.append(`<option value="${item.id}">${item.judul}</option>`);
            });
        },
        error: function (xhr) {
            alert('Terjadi kesalahan saat mengambil data Surat Keputusan.');
        }
    });

    // Tampilkan modal
    $('#editContentTabelTimKerja').modal('show');
});

// Handle form submission for updating Tim Kerja
$('#editContentTabelTimKerjaForm').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var id = $('#editContentTabelTimKerjaId').val();

    $.ajax({
        url: `/content/tabel_tim_kerja/update/${id}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            alert('Data updated successfully!');
            location.reload(); // Refresh the page to show the updated data
        },
        error: function (xhr) {
            alert('Error updating Tim Kerja.');
        }
    });
});
