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
        url: '/content/tim_kerja/data', // URL untuk mengambil data
        dataSrc: 'data'  // Mengambil data dari key "data"
      },
      columns: [
        {
          data: null,
          title: 'No',
          render: function (data, type, row, meta) {
            return meta.row + 1; // Menampilkan nomor urut
          },
          orderable: false // Menonaktifkan sorting untuk kolom ini
        },
        { data: 'judul', title: 'Nama' },  // Gantilah 'nama' menjadi 'judul' jika data yang diterima adalah 'judul'
        { data: 'cabang', title: 'Cabang' },
        { data: 'bidang', title: 'Bidang' },
        { data: 'id_sk', title: 'ID SK' },
        { 
          data: 'file', 
          title: 'File',
          render: function (data) {
            return data ? `<a href="/storage/${data}" target="_blank" class="btn btn-sm btn-primary">View PDF</a>` : 'No file';
          }
        },
        { 
          data: 'status', 
          title: 'Status',
          render: function (data) {
            if (data === 'Aktif') {
              return `<span class="badge p-2 bg-label-success mb-2 rounded">${data}</span>`;
            } else if (data === 'Tidak Aktif') {
              return `<span class="badge p-2 bg-label-warning mb-2 rounded">${data}</span>`;
            } else {
              return data;
            }
          }
        },
        { data: 'created_by.name', title: 'Created By' },  // Menampilkan 'name' dari objek 'created_by'
        {
          data: null,
          title: 'Actions',
          orderable: false,
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-primary edit-btn me-1" data-id="${row.id}" data-judul="${row.judul}" data-cabang="${row.cabang}" data-bidang="${row.bidang}" data-id_sk="${row.id_sk}" data-file="${row.file}" data-status="${row.status}" data-created_by="${row.created_by.name}">
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
            url: `/content/tim_kerja/delete/${id}`, // Updated URL for delete action
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


