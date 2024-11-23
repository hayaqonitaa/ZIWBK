'use strict';

$(function () {
  // Handle form submission for adding new prodi
  $('#addMahasiswaForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    var formData = $(this).serialize(); // Serialize form data

    // AJAX request to submit the form data
    $.ajax({
      url: '/mahasiswa/store', // URL to your store method in the controller
      type: 'POST',
      data: formData,
      success: function (response) {
        showAlert(response.message);
        setTimeout(function() {
          location.reload(); // Refresh the page after a short delay
        }, 2000);
      },
      error: function (xhr) {
        handleError(xhr);
      }
    });
  });

  $('#addMahasiswa').on('show.bs.modal', function () {
    $.ajax({
      url: '/prodi/data',
      type: 'GET',
      success: function (data) {
        console.log(data); // Cek apakah data muncul di console
        var prodiSelect = $('#prodi');
        prodiSelect.empty(); // Kosongkan pilihan yang ada di dropdown
  
        prodiSelect.append('<option value="" disabled selected>Pilih prodi</option>'); // Pilihan default
  
        // Looping melalui data prodi dan menambahkannya ke dropdown
        data.data.forEach(function (prodi) {
          prodiSelect.append(`<option value="${prodi.id}">${prodi.nama}</option>`);
        });
      },
      error: function (xhr) {
        // Handle error jika AJAX gagal
        alert('Terjadi kesalahan dalam memuat data prodi.');
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
      let alertMessage = xhr.responseJSON.message;

      // Mengecek apakah ada error pada prodi atau email dan menambahkannya ke pesan
      if (xhr.responseJSON.prodi_errors && xhr.responseJSON.prodi_errors.length > 0) {
          alertMessage += '\n\nProdi Salah di baris: ' + xhr.responseJSON.prodi_errors.join(', ');
      }

      if (xhr.responseJSON.email_errors && xhr.responseJSON.email_errors.length > 0) {
          alertMessage += '\nDuplikat email di baris: ' + xhr.responseJSON.email_errors.join(', ');
      }
      alert(alertMessage);
    } else {
      alert('An unexpected error occurred.');
    }
    location.reload();  // Halaman akan di-refresh setelah menutup alert
  }

  // upload file
  const dropzoneBasic = document.querySelector('#dropzone-basic');
  if (dropzoneBasic) {
    const myDropzone = new Dropzone(dropzoneBasic, {
      previewTemplate: previewTemplate,
      parallelUploads: 1,
      maxFilesize: 5,
      addRemoveLinks: true,
      maxFiles: 1
    });
  }

  
  $('#uploadExcelForm').on('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: '/mahasiswa/uploadExcel', // Sesuaikan dengan route di Laravel
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            showAlert(response.message);
            setTimeout(function() {
                location.reload(); // Reload halaman setelah sukses
            }, 2000);
        },
        error: function(xhr) {
            handleError(xhr);
        }
    });
});


});
