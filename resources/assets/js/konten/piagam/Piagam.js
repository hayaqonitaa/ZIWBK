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
        url: '/content/piagam/data', // URL untuk mendapatkan data dari controller Piagam
        dataSrc: 'data'
      },
      columns: [
        { 
          data: null, 
          title: 'No', 
          render: function (data, type, row, meta) {
            return meta.row + 1;
          },
          orderable: false
        },
        { data: 'judul', title: 'Judul' },
        { data: 'deskripsi', title: 'Deskripsi' },
        { 
          data: 'file', 
          title: 'File', 

          render: function (data, type, row) {
            return data ? `<img src="/storage/${data}" alt="${row.judul}" style="width: 100px; height: auto;">` : 'No image';
          }
        },
        { 
          data: 'status', 
          title: 'Status', 
          render: function (data) {
            return data === 'Aktif' 
              ? `<span class="badge bg-label-success">${data}</span>` 
              : `<span class="badge bg-label-warning">${data}</span>`;
          }
        },
        { 
          data: null, 
          title: 'Actions', 
          orderable: false,
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-primary edit-btn me-1" data-id="${row.id}" data-judul="${row.judul}" data-deskripsi="${row.deskripsi}" data-file="${row.file}" data-tahun="${row.tahun}" data-status="${row.status}">
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
  }
});
