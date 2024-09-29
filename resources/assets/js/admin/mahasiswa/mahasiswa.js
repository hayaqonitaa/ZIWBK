'use strict';

$(function () {
  // Set up CSRF token in AJAX requests
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var dt_scrollable_table = $('.dt-scrollableTable');

  // Scrollable
  // --------------------------------------------------------------------

  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: {
        url: '/mahasiswa/data', // ini ke web.php
        dataSrc: 'data' //  ini ke controller
      }, // 
      columns: [
        { 
          data: null, 
          title: 'No', 
          render: function (data, type, row, meta) {
            return meta.row + 1; // Menampilkan nomor urut berdasarkan index
          },
          orderable: false // Kolom ini tidak bisa diurutkan
        },
        { data: 'nim', title: 'NIM' },
        { data: 'nama', title: 'Nama' },
        { data: 'prodi.nama', title: 'Prodi' }, // Adjust to access prodi's name
        { data: 'email', title: 'Email' },
        { 
          data: null, 
          title: 'Actions', 
          orderable: false, // Column cannot be sorted
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-primary edit-btn me-1" data-id="${row.id}" data-nama="${row.nama}">
                <i class="fas fa-edit"></i> 
              </button>
              <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">
                <i class="fas fa-trash"></i> 
              </button>
            `;
          }
        }
      ],
      // Scroll options
      scrollY: '300px',
      scrollX: true,
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      initComplete: function (settings, json) {
        // Add the mti-n1 class to the first row in tbody
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
      }
    });

    // Handle edit button click


  // Handle edit button click
  $(document).on('click', '.edit-btn', function () {
    var NIM = $(this).data('nim');
    var nama = $(this).data('nama');
    var prodi = $(this).data('prodi');
    var email = $(this).data('email');

    // Set values in the edit modal
    $('#editNIM').val(NIM);
    $('#editNama').val(nama);
    $('#editProdi').val(prodi);
    $('#editEmail').val(email);
    $('#editMahasiswa').modal('show'); // Show the modal
  });

  // Handle form submission for editing Prodi
  $('#editMahasiswaForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    var formData = $(this).serialize(); // Serialize form data
    var id = $('#editMahasiswaId').val(); // Get the ID

    // AJAX request to submit the edit form data
    $.ajax({
      url: `/mahasiswa/update/${id}`, // URL to your update method in the controller
      type: 'PUT',
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



    // Handle delete action
    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');

        // Show SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#E3EBEA',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
            // Perform AJAX DELETE request
            $.ajax({
                url: `/mahasiswa/delete/${id}`, // URL to your delete method in the controller
                type: 'DELETE',
                success: function (response) {
                // Refresh the DataTable after deletion
                dt_scrollableTable.ajax.reload();
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
                },
                error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    Swal.fire('Error!', xhr.responseJSON.message, 'error');
                } else {
                    Swal.fire('Error!', 'An unexpected error occurred.', 'error');
                }
                }
            });
            }
        });
    });

  }
});
