'use strict';

$(function () {
  // Setup CSRF token for AJAX requests
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
        url: '/content/tabel_tim_kerja/data', // Pastikan URL sesuai dengan route yang benar
        dataSrc: 'data'
      },
      columns: [
        { 
          data: null, 
          title: 'No.', 
          render: function (data, type, row, meta) {
            return meta.row + 1; // Menampilkan nomor baris
          },
          orderable: false
        },
        { data: 'nama', title: 'Nama' },
        { data: 'nip', title: 'NIP' },
        { data: 'jabatan', title: 'Jabatan' },
        { 
          data: 'content.judul', 
          title: 'Surat Keputusan (SK)', 
          render: function (data, type, row) {
            const fileLink = row.content.file ? `/storage/${row.content.file}` : null;
            return fileLink 
              ? `<a href="${fileLink}" target="_blank" class="btn btn-sm btn-primary">View SK</a>` 
              : 'Tidak tersedia';
          }
        },
        { 
          data: null, 
          title: 'Actions', 
          orderable: false,
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-primary edit-btn me-1" 
                      data-id="${row.id}" 
                      data-nama="${row.nama}" 
                      data-nip="${row.nip}" 
                      data-jabatan="${row.jabatan}" 
                      data-id_sk="${row.id_sk}">
                <i class="fas fa-edit"></i>
              </button>
              <button class="btn btn-sm btn-danger delete-btn" 
                      data-id="${row.id}">
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

    // Delete action
    $(document).on('click', '.delete-btn', function () {
      var id = $(this).data('id');
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data ini akan dihapus secara permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/content/tabel_tim_kerja/delete/${id}`,
            type: 'DELETE',
            success: function (response) {
              dt_scrollableTable.ajax.reload();
              Swal.fire('Berhasil!', response.message, 'success');
            },
            error: function () {
              Swal.fire('Error!', 'Terjadi kesalahan.', 'error');
            }
          });
        }
      });
    });
  }
});
