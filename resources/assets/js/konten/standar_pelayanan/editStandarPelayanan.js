'use strict';

$(document).on('click', '.edit-btn', function () {
    var button = $(this);
    var id = button.data('id');
    $('#editContentStandarPelayananId').val(id);
    $('#editJudul').val(button.data('judul'));

    // Show the current image and PDF
    var imageFile = button.data('image');
    var pdfFile = button.data('pdf');
    var imageFileName = imageFile.split('/').pop(); // Extract the image file name
    var pdfFileName = pdfFile.split('/').pop(); // Extract the PDF file name

    $('#currentImageFile').text(imageFileName); // Display the image file name
    $('#currentPdfFile').text(pdfFileName); // Display the PDF file name

    // If the image file exists, display it
    $('#currentImage').attr('src', `/storage/${imageFile}`).show();

    // Retrieve and show the current status
    var currentStatus = button.data('status'); // Get the current status
    $('#currentStatus').text(currentStatus); // Display the current status
    $('#editStatus').val(currentStatus); // Set the current status in the dropdown

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

// Function to handle errors
function handleError(xhr) {
    if (xhr.responseJSON && xhr.responseJSON.message) {
        alert('Error: ' + xhr.responseJSON.message);
    } else {
        alert('An unexpected error occurred.');
    }
}
