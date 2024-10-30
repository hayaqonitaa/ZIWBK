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
        url: '/content/agen_perubahan/data', // URL to fetch data from
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
        { data: 'judul', title: 'Nama' },
        { data: 'deskripsi', title: 'Jabatan' },
        { 
          data: 'file', 
          title: 'Foto', 
          render: function (data, type, row) {
            return data ? `<img src="/storage/${data}" alt="${row.judul}" style="width: 100px; height: auto;">` : 'No image';
          }
        },
        { data: 'users.name', title: 'Created By' },
        { 
          data: null, 
          title: 'Actions', 
          orderable: false,
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-primary edit-btn me-1" data-id="${row.id}" data-judul="${row.judul}" data-deskripsi="${row.deskripsi}" data-file="${row.file}" data-id-Users="${row.users.id}" data-nama-Users="${row.users.name}">
                <i class="fas fa-edit"></i> 
              </button>
              <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">
                <i class="fas fa-trash"></i> 
              </button>
            `;
          }
        }
      ],
      scrollX: true,
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      initComplete: function () {
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
      }
    });

    // $(document).on('click', '.edit-btn', function () {
    //     var button = $(this);
    //     var id = button.data('id');
    //     $('#editContentAgenPerubahanId').val(id);
    //     $('#editJudul').val(button.data('judul'));
    //     $('#editDeskripsi').val(button.data('deskripsi'));
      
    //     // Show the current file or image
    //     var file = button.data('file');
    //     var fileName = file.split('/').pop(); // Extract the file name
    //     $('#currentFile').text(fileName); // Display the file name
      
    //     // If the file is an image, display it
    //     $('#currentFileImage').attr('src', `/storage/${file}`).show();
      
    //     $('#editContentAgenPerubahan').modal('show');
    //   });
      

    // // Form submission for editing content
    // $('#editContentAgenPerubahanForm').on('submit', function (e) {
    //   e.preventDefault();

    //   var formData = new FormData(this);
    //   var id = $('#editContentAgenPerubahanId').val();

    //   $.ajax({
    //     url: `/content/agen_perubahan/update/${id}`,
    //     type: 'POST',
    //     data: formData,
    //     processData: false,
    //     contentType: false,
    //     success: function (response) {
    //       showAlert(response.message);
    //       dt_scrollableTable.ajax.reload();
    //       $('#editContentAgenPerubahan').modal('hide');
    //     },
    //     error: function (xhr) {
    //       handleError(xhr);
    //     }
    //   });
    // });

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
            url: `/content/agen_perubahan/delete/${id}`,
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
