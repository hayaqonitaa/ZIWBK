'use strict';

$(function () {
    // Handle form submission for sharing questionnaire
    $('#shareQuestionnaireForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Ambil ID mahasiswa yang dipilih
        var selectedIds = $('.row-checkbox:checked').map(function() {
            return this.value; // Mengembalikan nilai checkbox yang terpilih
        }).get();

        if (selectedIds.length === 0) {
            alert('Silakan pilih mahasiswa terlebih dahulu.'); // Periksa apakah ada mahasiswa yang dipilih
            return;
        }

        // Pastikan untuk menambahkan id_kuesioner dan status dalam form data
        var formData = $(this).serializeArray(); // Serialize form data to an array

        // Tambahkan ID mahasiswa yang dipilih ke dalam form data tanpa JSON.stringify
        selectedIds.forEach(function(id) {
            formData.push({ name: 'mahasiswa_ids[]', value: id });
        });

        // AJAX request to submit the form data
        $.ajax({
            url: '/pembagian/share', // URL ke metode share di controller
            type: 'POST',
            data: formData,
            success: function (response) {
                showAlert(response.message);
                setTimeout(function() {
                    location.reload(); // Refresh halaman setelah delay singkat
                }, 2000);
            },
            error: function (xhr) {
                handleError(xhr);
            }
        });
    });

    // When the share questionnaire modal is shown
    $('#shareQuestionnaireModal').on('show.bs.modal', function () {
        // Ambil mahasiswa yang dipilih
        var selectedIds = $('.row-checkbox:checked').map(function() {
            return this.value; // Mengembalikan nilai checkbox yang terpilih
        }).get();
      
        if (selectedIds.length === 0) {
            alert('Silakan pilih mahasiswa terlebih dahulu.'); // Periksa apakah ada mahasiswa yang dipilih
            return;
        }
      
        // Tampilkan NIM mahasiswa yang dipilih
        var nimList = selectedIds.join(', '); // Gabungkan NIM menjadi string
        $('#selectedMahasiswa').val(nimList); // Simpan NIM mahasiswa yang dipilih ke input
        $('#selectedNIM').val(nimList); // Simpan NIM mahasiswa yang dipilih ke input tersembunyi

        // Ambil data kuesioner
        $.ajax({
            url: '/kuesioner/data', // Pastikan ini URL yang benar
            type: 'GET',
            success: function (response) {
                var questionnaireSelect = $('#questionnaireSelect');
                questionnaireSelect.empty(); // Kosongkan pilihan yang ada di dropdown
          
                questionnaireSelect.append('<option value="" disabled selected>Pilih Kuesioner</option>'); // Pilihan default
          
                // Looping melalui data kuesioner dan menambahkannya ke dropdown
                response.data.forEach(function (kuesioner) {
                    questionnaireSelect.append(`<option value="${kuesioner.id}">${kuesioner.judul}</option>`);
                });
            },
            error: function (xhr) {
                // Handle error jika AJAX gagal
                alert('Terjadi kesalahan dalam memuat data kuesioner.');
            }
        });
    });

    // Function to show alert
    function showAlert(message) {
        var alertDiv = $(` 
            <div class="alert alert-success" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                <i class="fas fa-check-circle me-2"></i>
                <div>${message}</div>
            </div>
        `);
        $('body').append(alertDiv);
        setTimeout(function() {
            alertDiv.fadeOut('slow', function() {
                $(this).remove(); // Remove alert after fade out
            });
        }, 3000);
    }

    // Function to handle errors
    function handleError(xhr) {
        if (xhr.responseJSON && xhr.responseJSON.message) {
            alert('Error: ' + xhr.responseJSON.message);
        } else {
            alert('An unexpected error occurred.');
        }
    }
});
