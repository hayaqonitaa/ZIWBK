'use strict';

$(function () {
  // Handle edit button click
  $(document).on('click', '.edit-btn', function () {
    var id = $(this).data('id');
    var judul = $(this).data('judul');
    var link_kuesioner = $(this).data('linkKuesioner');

    console.log($(this).data())
    
    // Set values in the edit modal
    $('#editKuesionerId').val(id);
    $('#editJudul').val(judul);
    $('#editLink').val(link_kuesioner);
    $('#editKuesioner').modal('show'); // Show the modal
  });

  // Handle form submission for editing kuesioner
  $('#editKuesionerForm').on('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    var formData = $(this).serialize(); // Serialize form data
    var id = $('#editKuesionerId').val(); // Get the ID

    // Append the method PUT to the form data for Laravel
    formData += '&_method=PUT';

    // AJAX request to submit the edit form data
    $.ajax({
      url: '/kuesioner/update/' + id, // Use the actual id in the URL
      type: 'POST', // Use POST because we are appending method PUT manually
      data: formData,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
      },
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
});
