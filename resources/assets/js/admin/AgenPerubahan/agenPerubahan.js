'use strict';

$(function () {
  // Set up CSRF token in AJAX requests
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var dt_scrollable_table = $('.dt-scrollableTable');

  // Initialize DataTable
  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: {
        url: '/agen-perubahan/data', // Endpoint to fetch data
        dataSrc: 'data' // Path to data in the response
      },
      columns: [
        { 
          data: null, 
          title: 'No', 
          render: function (data, type, row, meta) {
            return meta.row + 1; // Display row number
          },
          orderable: false // Column cannot be sorted
        },
        { data: 'nama', title: 'Nama' },
        { data: 'jabatan', title: 'Jabatan' },
        { data: 'foto', title: 'Jabatan' },
        { data: 'status', title: 'Jabatan' },
        { data: 'masa_jabatan', title: 'Jabatan' },
        { 
          data: null, 
          title: 'Actions', 
          orderable: false, // Column cannot be sorted
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-primary edit-btn me-1" data-id="${row.id}" data-nama="${row.nama}" data-jabatan="${row.jabatan}">
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
      initComplete: function (settings, json) {
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
      }
    });

    // // Handle edit button click
    // $(document).on('click', '.edit-btn', function () {
    //   var id = $(this).data('id');
    //   var nama = $(this).data('nama');
    //   var jabatan = $(this).data('jabatan');
      
    //   // Set values in the edit modal
    //   $('#editAgenPerubahanId').val(id);
    //   $('#editNama').val(nama);
    //   $('#editJabatan').val(jabatan);
    //   $('#editAgenPerubahan').modal('show'); // Show the modal
    // });

    // // Handle delete action
    // $(document).on('click', '.delete-btn', function () {
    //   var id = $(this).data('id');

    //   // Show SweetAlert2 confirmation dialog
    //   Swal.fire({
    //     title: 'Are you sure?',
    //     text: "You won't be able to revert this!",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#d33',
    //     cancelButtonColor: '#E3EBEA',
    //     confirmButtonText: 'Yes, Delete',
    //     cancelButtonText: 'Cancel'
    //   }).then((result) => {
    //     if (result.isConfirmed) {
    //       // Perform AJAX DELETE request
    //       $.ajax({
    //         url: `/agen-perubahan/delete/${id}`, // URL to your delete method in the controller
    //         type: 'DELETE',
    //         success: function (response) {
    //           // Refresh the DataTable after deletion
    //           dt_scrollableTable.ajax.reload();
    //           Swal.fire({
    //             icon: 'success',
    //             title: 'Deleted!',
    //             text: response.message,
    //             timer: 2000,
    //             showConfirmButton: false
    //           });
    //         },
    //         error: function (xhr) {
    //           if (xhr.responseJSON && xhr.responseJSON.message) {
    //             Swal.fire('Error!', xhr.responseJSON.message, 'error');
    //           } else {
    //             Swal.fire('Error!', 'An unexpected error occurred.', 'error');
    //           }
    //         }
    //       });
    //     }
    //   });
    // });
  }
});