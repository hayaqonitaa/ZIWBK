'use strict';

$(function () {

  // buat input
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
        url: '/prodi/data', // ini ke web.php
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
        { data: 'nama', title: 'Nama' },
        { data: 'jurusan.nama', title: 'Jurusan' },
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
      scrollX: true,
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      initComplete: function (settings, json) {
        // Add the mti-n1 class to the first row in tbody
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
      }
    });
        // Handle edit button click
        $(document).on('click', '.edit-btn', function () {
          var id = $(this).data('id');
          var nama = $(this).data('nama');
          
          // Set values in the edit modal
          $('#editJurusanId').val(id);
          $('#editNama').val(nama);
          $('#editJurusan').modal('show'); // Show the modal
        });
    
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
                url: `/prodi/delete/${id}`, // URL to your delete method in the controller
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
