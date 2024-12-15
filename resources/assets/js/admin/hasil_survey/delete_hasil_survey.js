$(function () {
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
  
    // Handle delete action
    $(document).on('click', '.delete-btn', function () {
      var id = $(this).data('id');
  
      // Show SweetAlert2 confirmation dialog
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // Perform AJAX DELETE request
          $.ajax({
            url: `/hasil_survey/delete/${id}`, // URL to your delete method in the controller
            type: 'DELETE',
            success: function (response) {
              // Refresh the DataTable after deletion
              dt_scrollableTable.ajax.reload();
  
              // Show success notification
              showAlert('Data has been successfully deleted!');
              
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
  });
  