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

    // Function to show notifications
    function showNotification(message, type = 'success') {
      const alertDiv = $(`
        <div class="alert alert-${type}" role="alert" style="top: 20px; right: 20px; z-index: 9999;">
          <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-times-circle'} me-2"></i>
          ${message}
        </div>
      `);
      $('body').append(alertDiv);

      // Automatically hide and remove the alert after 3 seconds (3000 milliseconds)
      setTimeout(() => alertDiv.fadeOut('slow', () => alertDiv.remove()), 3000);
    }

    // Handle file import via AJAX
    $('#importForm').on('submit', function (e) {
      e.preventDefault();
      
      var formData = new FormData(this);

      $.ajax({
        url: '/hasil-survey/import',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          // Display success message
          showNotification(response.message, 'success');
          
          // Check if there are errors and display them
          if (response.errors && response.errors.length > 0) {
            response.errors.forEach(function(error) {
              if (error.error.includes('NIM')) {
                showNotification(`Row ${error.row}: ${error.error}`, 'danger');
              } else if (error.error.includes('Kuisioner')) {
                showNotification(`Row ${error.row}: ${error.error}`, 'danger');
              }
            });
          }

          // Optionally, handle the number of surveys added
          if (response.surveyAdded > 0) {
            showNotification(`${response.surveyAdded} surveys added successfully!`, 'success');
          }
        },
        error: function () {
          // Display error message if something goes wrong
          showNotification('An error occurred during the import process.', 'danger');
        }
      });
    });
    
    // Export DataTable instance
    window.dt_scrollableTable = dt_scrollableTable;
  }
});
