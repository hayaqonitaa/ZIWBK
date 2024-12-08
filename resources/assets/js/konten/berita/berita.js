'use strict';

$(function () {
  // CSRF Token Setup
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var dt_scrollable_table = $('.dt-scrollableTable');

  // Initialize Scrollable DataTable
  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: {
        url: '/content/berita/data', // URL to fetch data from
        dataSrc: 'data' // Data source from the controller
      },
      columns: [
        { 
          data: null, 
          title: 'No', 
          render: function (data, type, row, meta) {
            return meta.row + 1; // Display row number
          },
          orderable: false // Disable sorting for this column
        },
        { data: 'judul', title: 'Judul' },
        // { data: 'deskripsi', title: 'Deskripsi' },
        { 
          data: 'file', 
          title: 'Gambar', 
          render: function (data, type, row) {
            return data ? `<img src="/storage/${data}" alt="${row.judul}" style="width: 100px; height: auto;">` : 'No image';
          }
        },
        // { 
        //   data: 'link', 
        //   title: 'Link', 
        //   render: function (data, type, row) {
        //     return data ? `<a href="${data}" target="_blank" class="btn btn-sm btn-info">Visit Link</a>` : 'No link';
        //   }
        // },
        { data: 'users.name', title: 'Created By' },
        { 
          data: 'status', 
          title: 'Status', 
          render: function (data, type, row) {
            if (data === 'Aktif') {
              return `<span class="badge p-2 bg-label-success mb-2 rounded">${data}</span>`; // Hijau untuk status Aktif
            } else if (data === 'Tidak Aktif') {
              return `<span class="badge p-2 bg-label-warning mb-2 rounded">${data}</span>`; // Kuning untuk status Tidak Aktif
            } else {
              return data; // Default, jika status lain
            }
          }
        },
        { 
          data: null, 
          title: 'Actions', 
          orderable: false,
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-primary edit-btn me-1" data-id="${row.id}" data-judul="${row.judul}" data-deskripsi="${row.deskripsi}" data-file="${row.file}" data-link="${row.link}" data-id-Users="${row.users.id}" data-nama-Users="${row.users.name}" data-status="${row.status}">
                <i class="fas fa-edit"></i> 
              </button>
              <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">
                <i class="fas fa-trash"></i> 
              </button>
            `;
          }
        }
      ],
        orderCellsTop: true,
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        initComplete: function (settings, json) {
            // Add the mti-n1 class to the first row in tbody
            dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');

        }
    });

    $(document).on('click', '.edit-btn', function () {
      var button = $(this);
      var id = button.data('id');
      
      // Set form fields with existing data
      $('#editContentBeritaId').val(id);
      $('#editJudul').val(button.data('judul'));
      
      // Update the TinyMCE editor content
      tinymce.get('editDeskripsi').setContent(button.data('deskripsi'));
  
      // Show current file name and preview
      var file = button.data('file');
      if (file) {
          var fileName = file.split('/').pop(); // Extract the file name
          $('#currentFile').text(fileName); // Display file name
          $('#currentFileImage').attr('src', `/storage/${file}`).show(); // Show image preview
      } else {
          $('#currentFile').text('No file uploaded');
          $('#currentFileImage').hide(); // Hide image preview if no file exists
      }
  
      // Set and display current status
      var currentStatus = button.data('status');
      $('#currentStatus').text(currentStatus); // Display status
      $('#editStatus').val(currentStatus); // Set status dropdown value
  
      // Open the modal
      $('#editContentBerita').modal('show');
  });
  

    // Form submission for editing content
    $('#editContentBeritaForm').on('submit', function (e) {
      e.preventDefault();

      var formData = new FormData(this);
      var id = $('#editContentBeritaId').val();

      $.ajax({
        url: `/content/berita/update/${id}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          showAlert(response.message);
          dt_scrollableTable.ajax.reload();
          $('#editContentBerita').modal('hide');
        },
        error: function (xhr) {
          handleError(xhr);
        }
      });
    });

    // Show alert message
    function showAlert(message) {
      var alertDiv = $(`
        <div class="alert alert-success" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
          <i class="fas fa-check-circle me-2"></i>
          ${message}
        </div>
      `);
      $('body').append(alertDiv);
      setTimeout(function () {
        alertDiv.fadeOut('slow', function () {
          $(this).remove();
        });
      }, 3000);
    }

    // Delete action with confirmation
    $(document).on('click', '.delete-btn', function () {
      var id = $(this).data('id');

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
          $.ajax({
            url: `/content/berita/delete/${id}`,
            type: 'DELETE',
            success: function (response) {
              dt_scrollableTable.ajax.reload();
              Swal.fire('Deleted!', response.message, 'success');
            },
            error: function (xhr) {
              Swal.fire('Error!', 'An unexpected error occurred.', 'error');
            }
          });
        }
      });
    });
  }
});
