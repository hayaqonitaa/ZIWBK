'use strict';

$(function () {
  $(document).on('click', '.edit-btn', function () {
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    
    $('#editContentCategoryId').val(id);
    $('#editNama').val(nama);
    $('#editContentCategoriesModal').modal('show');
  });

  $('#editContentCategoriesForm').on('submit', function (e) {
    e.preventDefault();

    var formData = $(this).serialize();
    var id = $('#editContentCategoryId').val();

    formData += '&_method=PUT';

    $.ajax({
      url: '/content-categories/update/' + id,
      type: 'POST',
      data: formData,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        showAlert(response.message);
        setTimeout(function() {
          location.reload();
        }, 2000);
      },
      error: function (xhr) {
        handleError(xhr);
      }
    });
  });

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
        $(this).remove();
      });
    }, 3000);
  }

  function handleError(xhr) {
    if (xhr.responseJSON && xhr.responseJSON.message) {
      alert('Error: ' + xhr.responseJSON.message);
    } else {
      alert('An unexpected error occurred.');
    }
  }
});
