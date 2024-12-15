$(document).ready(function () {
  // Setup CSRF token for all AJAX requests
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
  });

  // Handle form submit for file import
  $(document).on('submit', '#importForm', function (e) {
    e.preventDefault(); // Prevent default form submission

    let formData = new FormData(this);

    $.ajax({
      url: '/hasil-survey/import', // URL endpoint untuk import
      type: 'POST',
      data: formData,
      contentType: false, // Jangan set tipe konten secara manual
      processData: false, // Jangan proses data secara manual
      success: function (response) {
        // Tampilkan pesan sukses
        alert(response.message);

        // Tampilkan jumlah data yang berhasil ditambahkan
        if (response.surveyAdded > 0) {
          alert(response.surveyAdded + ' hasil survey berhasil ditambahkan.');
        }

        // Tampilkan error jika ada
        if (response.errors && response.errors.length > 0) {
          let errorMessages = response.errors
            .map(
              (error) =>
                `Baris ${error.row}: ${error.error}`
            )
            .join('\n');
          alert('Terjadi kesalahan pada baris berikut:\n' + errorMessages);
        }

        // Refresh DataTable jika ada
        if (window.dt_scrollableTable) {
          window.dt_scrollableTable.ajax.reload();
        }
      },
      error: function (xhr) {
        // Tampilkan error validasi
        if (xhr.status === 422) {
          let errors = xhr.responseJSON.errors.file;
          alert(errors.join('\n'));
        } else {
          alert('Terjadi kesalahan saat mengimpor data.');
        }
      },
    });
  });

  // Inisialisasi DataTable
  var dt_scrollable_table = $('.dt-scrollableTable');

  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: {
        url: '/hasil_survey/data', // URL endpoint untuk mendapatkan data
        dataSrc: 'data',
      },
      columns: [
        {
          data: null,
          title: 'No',
          render: function (data, type, row, meta) {
            return meta.row + 1;
          },
          orderable: false,
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
          },
        },
      ],
      dom:
        '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>' +
        '<"table-responsive"t>' +
        '<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      initComplete: function () {
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
      },
    });

    // Export DataTable instance
    window.dt_scrollableTable = dt_scrollableTable;
  }
});
