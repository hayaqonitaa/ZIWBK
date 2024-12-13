'use strict';

$(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var dt_scrollable_table = $('.dt-scrollableTable');

  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: {
        url: '/hasil_survey/data',
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
        { data: 'nim', title: 'NIM' },
        { data: 'kuesioner.judul', title: 'Kuesioner' },
        { data: 'pertanyaan', title: 'Pertanyaan' },
        { data: 'jawaban', title: 'Jawaban' },
        { data: 'semester', title: 'Semester' },
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
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>' +
           '<"table-responsive"t>' +
           '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      initComplete: function () {
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
      }
    });

    // Fungsi notifikasi
    function showNotification(message, type = 'success') {
      const alertDiv = $(`
        <div class="alert alert-${type}" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
          <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-times-circle'} me-2"></i>
          ${message}
        </div>
      `);
      $('body').append(alertDiv);
      setTimeout(() => alertDiv.fadeOut('slow', () => alertDiv.remove()), 3000);
    }

    // Export DataTable instance
    window.dt_scrollableTable = dt_scrollableTable;
  }
});
