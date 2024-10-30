'use strict';

$(document).on('click', '.edit-btn', function () {
    var button = $(this);
    var id = button.data('id');
    $('#editContentAgenPerubahanId').val(id);
    $('#editJudul').val(button.data('judul'));
    $('#editDeskripsi').val(button.data('deskripsi'));

    // Show the current file or image
    var file = button.data('file');
    var fileName = file.split('/').pop(); // Extract the file name
    $('#currentFile').text(fileName); // Display the file name

    // If the file is an image, display it
    $('#currentFileImage').attr('src', `/storage/${file}`).show();

    $('#editContentAgenPerubahan').modal('show');
});

// Form submission for editing content
$('#editContentAgenPerubahanForm').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var id = $('#editContentAgenPerubahanId').val();

    $.ajax({
        url: `/content/agen_perubahan/update/${id}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            showAlert(response.message);
            // Refresh the page after the update
            location.reload(); // This will refresh the entire page
        },
        error: function (xhr) {
            handleError(xhr);
        }
    });
});


// Show alert message
function showAlert(message) {
    var alertDiv = $(`
        <div class="alert alert-success" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            <i class="fas fa-check-circle me-2"></i>
            ${message}
        </div>
    `);
    $('body').append(alertDiv);
    setTimeout(function () {
        alertDiv.fadeOut('slow', function () {
            $(this).remove();
        });
    }, 3000);
}
