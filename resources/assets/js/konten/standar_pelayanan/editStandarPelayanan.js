'use strict';

$(document).on('click', '.edit-btn', function () {
    var button = $(this);
    var id = button.data('id');
    $('#editContentStandarPelayananId').val(id);
    $('#editJudul').val(button.data('judul'));

    // Show the current image and PDF
    var deskripsi = button.data('deskripsi') || '';
    var file = button.data('file') || '';
    var imageFileName = deskripsi ? deskripsi.split('/').pop() : 'No image available';
    var pdfFileName = file ? file.split('/').pop() : 'No PDF available';

    $('#currentImageFile').text(imageFileName);
    $('#currentPdfFile').text(pdfFileName);

    // If the image file exists, display it
    if (deskripsi) {
        $('#currentImageFile').attr('src', `/storage/${deskripsi}`).show();
    } else {
        $('#currentImage').hide();
    }

    // Retrieve and show the current status
    var currentStatus = button.data('status') || 'inactive';
    $('#currentStatus').text(currentStatus);
    $('#editStatus').val(currentStatus);

    $('#editContentStandarPelayanan').modal('show');
});

// Form submission for editing content
$('#editContentStandarPelayananForm').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var id = $('#editContentStandarPelayananId').val();

    $.ajax({
        url: `/content/standar_pelayanan/update/${id}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            showAlert(response.message);
            location.reload();
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

// Function to handle errors
function handleError(xhr) {
    if (xhr.responseJSON && xhr.responseJSON.errors) {
        let errors = xhr.responseJSON.errors;
        let errorMessage = '';
        for (const key in errors) {
            if (errors.hasOwnProperty(key)) {
                errorMessage += errors[key] + '\n';
            }
        }
        alert('Error:\n' + errorMessage);
    } else if (xhr.responseJSON && xhr.responseJSON.message) {
        alert('Error: ' + xhr.responseJSON.message);
    } else {
        alert('An unexpected error occurred.');
    }
}
