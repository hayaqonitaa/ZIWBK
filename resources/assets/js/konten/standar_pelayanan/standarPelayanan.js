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
        url: '/content/standar_pelayanan/data', // URL to fetch data from
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

        { 
            data: 'deskripsi', // Kolom deskripsi digunakan untuk gambar
            title: 'Gambar', 
            render: function (data, type, row) {
              return data ? `<img src="/storage/${data}" alt="Image" style="width: 100px;">` : 'No image';
            }
          },
          { 
            data: 'file', // Kolom file digunakan untuk PDF
            title: 'PDF', 
            render: function (data) {
              return data ? `<a href="/storage/${data}" target="_blank">View PDF</a>` : 'No file';
            }
          },

        { data: 'status', title: 'Status', 
          render: function (data) {
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
              <button class="btn btn-sm btn-primary edit-btn me-1" data-id="${row.id}" data-judul="${row.judul}" data-image="${row.deskripsi}" data-pdf="${row.file}" data-status="${row.status}">
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
      initComplete: function () {
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
      }
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
            url: `/content/standar_pelayanan/delete/${id}`,
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
