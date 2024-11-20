'use strict';

$(function () {
  // Set up AJAX with CSRF token
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
        url: '/pembagian/data', // URL ke web.php
        dataSrc: 'data' // Sumber data dari controller
      },
      columns: [
        { 
          data: null, 
          title: '<input type="checkbox" id="select-all">', // Checkbox untuk memilih semua
          orderable: false,
          searchable: false,
          render: function (data, type, row) {
            return `<input type="checkbox" class="row-checkbox" value="${row.id}">`; // Checkbox per baris
          }
        },
        { 
          data: null, 
          title: 'No', 
          render: function (data, type, row, meta) {
            return meta.row + 1; // Menampilkan nomor urut berdasarkan index
          },
          orderable: false // Kolom ini tidak bisa diurutkan
        },
        { data: 'mahasiswa.nim', title: 'NIM' },
        { data: 'mahasiswa.nama', title: 'Nama' },
        { data: 'kuesioner.judul', title: 'Judul' },
        {
          data: 'status',
          title: 'Status',
          render: function (data, type, row) {
            if (data === 'Sudah Terkirim') {
              return `<span class="badge p-2 bg-label-success mb-2 rounded">${data}</span>`; // Hijau untuk status Sudah Terkirim
            } else if (data === 'Belum Dikirim') {
              return `<span class="badge p-2 bg-label-warning mb-2 rounded">${data}</span>`; // Kuning untuk status Belum Dikirim
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
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
      }
    });

    // Handle "Select All" checkbox click
    $(document).on('click', '#select-all', function () {
      var isChecked = this.checked;
      $('.row-checkbox').each(function () {
        this.checked = isChecked;
      });
    });

    // Handle individual row checkbox click
    $(document).on('change', '.row-checkbox', function () {
      var allCheckboxes = $('.row-checkbox');
      var checkedCheckboxes = allCheckboxes.filter(':checked');

      // Set "Select All" checkbox state
      $('#select-all').prop('checked', allCheckboxes.length === checkedCheckboxes.length);
    });

    // Handle button "Kirim" click
    $(document).on('click', '.btn-success', function () {
      var selectedIds = [];
      var selectedData = [];

      // Loop through each checked checkbox
      $('.row-checkbox:checked').each(function () {
        var row = $(this).closest('tr');
        var nim = row.find('td:eq(2)').text(); // Column NIM (adjust index as needed)
        var nama = row.find('td:eq(3)').text();  // Column Nama (adjust index as needed)

        selectedIds.push($(this).val());
        selectedData.push({ nim: nim, nama: nama });
      });

      if (selectedIds.length > 0) {
        // Show selected data in modal
        var selectedDataList = $('#selectedDataList');
        selectedDataList.empty(); // Clear previous list
        selectedData.forEach(function (item) {
          selectedDataList.append('<li>' + item.nim + ' - ' + item.nama + '</li>');
        });

        // Store selected IDs in hidden input
        $('#selectedIds').val(selectedIds.join(','));

        // Show the modal
        $('#sendModal').modal('show');
      } else {
        // Show notification if no data is selected
        Swal.fire('Pilih Data', 'Silakan pilih minimal satu data untuk dikirim.', 'warning');
      }
    });

    // Handle confirm send button click
    $('#confirmSend').on('click', function () {
      var selectedIds = $('#selectedIds').val();

      if (selectedIds) {
        $.ajax({
          url: '/pembagian/kirim', // Adjust to your actual URL for sending data
          type: 'POST',
          data: {
            ids: selectedIds
          },
          success: function (response) {
            // Update status for each selected ID to "Sudah Terkirim"
            selectedIds.split(',').forEach(function (id) {
              // Find the row in DataTable and update the status column
              var row = dt_scrollableTable.rows().data().toArray().find(row => row.id === id);
              if (row) {
                row.status = 'Sudah Terkirim'; // Update status
              }
            });

            dt_scrollableTable.clear().rows.add(dt_scrollableTable.rows().data()).draw(); // Refresh DataTable

            Swal.fire('Sukses', 'Data berhasil dikirim dan email telah terkirim.', 'success');
            setTimeout(function () {
              location.reload(); // Refresh the page after success
            }, 2000);
          },
          error: function (xhr) {
            Swal.fire('Error!', 'Terjadi kesalahan saat mengirim data.', 'error');
          }
        });
      }
    });

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
              url: `/pembagian/delete/${id}`, // URL to your delete method in the controller
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
