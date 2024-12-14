$(function () {
  var dt_scrollable_table = $('.dt-scrollableTable');

  // Inisialisasi DataTables jika elemen ditemukan
  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: {
        url: '/hasil_survey/data', // Route untuk mengambil data hasil survey
        dataSrc: 'data'
      },
      columns: [
        {
          data: null,
          title: 'No',
          render: function (data, type, row, meta) {
            return meta.row + 1; // Menampilkan nomor urut berdasarkan index
          },
          orderable: false,
          searchable: false
        },
        { data: 'nim', title: 'NIM' },
        {
          data: 'kuesioner.nama',
          title: 'Kuesioner',
          defaultContent: '-' // Menangani data yang null
        },
        {
          data: 'pertanyaan',
          title: 'Pertanyaan',
          render: function (data) {
            return data ? data : '-'; // Menangani null atau undefined
          }
        },
        {
          data: 'jawaban',
          title: 'Jawaban',
          render: function (data) {
            return data ? data : '-'; // Menangani null atau undefined
          }
        },
        {
          data: 'semester',
          title: 'Semester',
          render: function (data) {
            return data ? `Semester ${data}` : '-'; // Format semester
          }
        }
      ],
      orderCellsTop: true,
      dom: `
        <"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>
        <"table-responsive"t>
        <"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>
      `,
      responsive: true,
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data per halaman",
        zeroRecords: "Tidak ada data yang ditemukan",
        info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
        infoEmpty: "Tidak ada data tersedia",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Berikutnya",
          previous: "Sebelumnya"
        }
      },
      initComplete: function () {
        console.log('DataTables initialized successfully.');
      }
    });
  }

  // Form upload Excel
  $('#uploadExcelForm').on('submit', function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: '/hasil_survey/import', // Pastikan URL sesuai dengan route
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
        // Tambahkan loader sebelum request dikirim
        $('#uploadExcelButton').prop('disabled', true).text('Mengunggah...');
      },
      success: function (response) {
        // Tampilkan pesan sukses dan refresh tabel
        alert('Data berhasil diunggah!');
        $('#uploadExcelButton').prop('disabled', false).text('Unggah');
        if (dt_scrollableTable) {
          dt_scrollableTable.ajax.reload(null, false); // Reload data tetap di halaman saat ini
        }
      },
      error: function (xhr) {
        // Tampilkan pesan error
        console.error(xhr.responseJSON);
        var errorMessage = 'Terjadi kesalahan saat mengunggah data.';
        if (xhr.responseJSON && xhr.responseJSON.message) {
          errorMessage = xhr.responseJSON.message;
        }
        alert(errorMessage);
        $('#uploadExcelButton').prop('disabled', false).text('Unggah');
      }
    });
  });
});
