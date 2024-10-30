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
            url: '/mahasiswa/data', // URL untuk mengambil data mahasiswa
            dataSrc: 'data' // Sumber data dari controller
        },
        columns: [
            { 
                data: null, 
                title: '<input type="checkbox" id="selectAll">', // Checkbox untuk Select All
                orderable: false, // Kolom tidak dapat diurutkan
                render: function (data, type, row) {
                  return `<input type="checkbox" class="row-checkbox" value="${row.nama}" data-nama="${row.nama}" data-jurusan="${row.jurusan}">`;
                }
            },
            { 
                data: null, 
                title: 'No', 
                render: function (data, type, row, meta) {
                    return meta.row + 1; // Menampilkan nomor urut berdasarkan index
                },
                orderable: false // Kolom tidak bisa diurutkan
            },
            { data: 'nim', title: 'NIM' },
            { data: 'nama', title: 'Nama' },
            { data: 'prodi.nama', title: 'Prodi' }, // Akses nama prodi
            { data: 'email', title: 'Email' },
            { 
                data: null, 
                title: 'Actions', 
                orderable: false, // Kolom tidak dapat diurutkan
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-primary edit-btn me-1" data-id="${row.id}" data-nim="${row.nim}" data-nama="${row.nama}" data-prodi="${row.prodi.nama}" data-email="${row.email}">
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

    // Handle individual row checkbox click
    dt_scrollable_table.on('click', '.row-checkbox', function () {
      if (!this.checked) {
        $('#selectAll').prop('checked', false);
      }
    });

    // Handle "Select All" checkbox
    $('#selectAll').on('click', function () {
      var isChecked = $(this).is(':checked'); // Check status of the Select All checkbox
      $('.row-checkbox').prop('checked', isChecked); // Set all row checkboxes to the same status
    });


    $('#editMahasiswa').on('show.bs.modal', function () {
      $.ajax({
        url: '/prodi/data',
        type: 'GET',
        success: function (data) {
          console.log(data); // Cek apakah data muncul di console
          var prodiSelect = $('#editProdi');
          prodiSelect.empty(); // Kosongkan pilihan yang ada di dropdown
    
          prodiSelect.append('<option value="" disabled selected>Pilih prodi</option>'); // Pilihan default
    
          // Looping melalui data prodi dan menambahkannya ke dropdown
          data.data.forEach(function (prodi) {
            prodiSelect.append(`<option value="${prodi.id}">${prodi.nama}</option>`);
          });
        },
        error: function (xhr) {
          // Handle error jika AJAX gagal
          alert('Terjadi kesalahan dalam memuat data prodi.');
        }
      });
    });
    
    // Handle button "Kirim" click
    $(document).on('click', '.btn-info', function () {
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
        var selectedDataList = $('#selectedMahasiswa');
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

    // Handle edit button click
    $(document).on('click', '.edit-btn', function () {
      var nim = $(this).data('nim');
      var nama = $(this).data('nama');
      var prodi = $(this).data('prodi');
      var email = $(this).data('email');
      var id = $(this).data('id');
      console.log($(this).data());

      // Set values in the edit modal
      $('#editNimMhs').val(nim);
      $('#editMahasiswaId').val(id)
      $('#editNama').val(nama);
      $('#editProdi').val(prodi);
      $('#editEmail').val(email);
      $('#editMahasiswa').modal('show'); // Show the modal
    });

    // Handle form submission for editing Mahasiswa
    $('#editMahasiswaForm').on('submit', function (e) {
      e.preventDefault(); // Prevent the default form submission

      var formData = $(this).serialize(); // Serialize form data
      var id = $('#editMahasiswaId').val(); // Get the ID
      console.log(formData);

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
