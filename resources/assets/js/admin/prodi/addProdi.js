'use strict';

$(function () {
  // Handle form submission for adding new jurusan
  $('#addProdiForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    var formData = $(this).serialize(); // Serialize form data

    // AJAX request to submit the form data
    $.ajax({
      url: '/prodi/store', // URL to your store method in the controller
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

  $('#addProdi').on('show.bs.modal', function () {
    $.ajax({
      url: '/jurusan/data',
      type: 'GET',
      success: function (data) {
        console.log(data); // Cek apakah data muncul di console
        var jurusanSelect = $('#jurusan');
        jurusanSelect.empty(); // Kosongkan pilihan yang ada di dropdown
  
        jurusanSelect.append('<option value="" disabled selected>Pilih Jurusan</option>'); // Pilihan default
  
        // Looping melalui data jurusan dan menambahkannya ke dropdown
        data.data.forEach(function (jurusan) {
          jurusanSelect.append(`<option value="${jurusan.id}">${jurusan.nama}</option>`);
        });
      },
      error: function (xhr) {
        // Handle error jika AJAX gagal
        alert('Terjadi kesalahan dalam memuat data jurusan.');
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
      alert(xhr.responseJSON.message);
    } else {
      alert('An unexpected error occurred.');
    }
  }
});
