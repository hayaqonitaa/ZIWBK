'use strict';

$(function () {
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
        { data: 'jurusan.nama', title: 'Jurusan' }, // Adjust to access prodi's name
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
  }
});
