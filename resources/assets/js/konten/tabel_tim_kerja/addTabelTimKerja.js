'use strict';

$(function () {
  // Setup CSRF token for AJAX requests
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // Handle form submission for adding new Tim Kerja
  $('#addContentTabelTimKerjaForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    var formData = new FormData(this); // Use FormData to handle file uploads

    // AJAX request to submit the form data
    $.ajax({
      url: '/content/tabel_tim_kerja/store', // URL to your store method in the controller
      type: 'POST',
      data: formData,
      contentType: false, // Set content type to false for FormData
      processData: false, // Prevent jQuery from processing the data
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

  $('#addContentTabelTimKerja').on('show.bs.modal', function () {
    $.ajax({
      url: '/content/tim_kerja/data',
      type: 'GET',
      success: function (data) {
        console.log(data); // Cek apakah data muncul di console
        var idSkSelect = $('#sk');
        idSkSelect.empty(); // Kosongkan pilihan yang ada di dropdown
  
        idSkSelect.append('<option value="" disabled selected>Pilih Surat Keputusan</option>'); // Pilihan default
  
        // Looping melalui data dan menambahkannya ke dropdown
        data.data.forEach(function (item) {
          idSkSelect.append(`<option value="${item.id}">${item.judul}</option>`);
        });
      },
      error: function (xhr) {
        // Handle error jika AJAX gagal
        alert('Terjadi kesalahan dalam memuat surat keputusan.');
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
