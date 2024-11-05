'use strict';

$(document).on('click', '.edit-btn', function () {
    var button = $(this);
    var id = button.data('id');
    $('#editContentTimKerjaId').val(id);
    $('#editJudul').val(button.data('judul'));

    // Show the current PDF file if it exists
    var pdfFile = button.data('pdf');
    if (pdfFile) {
        var pdfFileName = pdfFile.split('/').pop(); // Extract the PDF file name
        $('#currentPdfFileLink')
            .attr('href', `/storage/${pdfFile}`) // Set the href to the PDF file location
            .text(pdfFileName) // Display the PDF file name as link text
            .show(); // Make the link visible
    } else {
        $('#currentPdfFileLink').hide(); // Hide if there's no PDF
    }

    // Retrieve and show the current status
    var currentStatus = button.data('status'); // Get the current status
    $('#currentStatus').text(currentStatus); // Display the current status
    $('#editStatus').val(currentStatus); // Set the current status in the dropdown

    $('#editContentTimKerja').modal('show');
});

// Form submission for editing Tim Kerja
$('#editContentTimKerjaForm').on('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var id = $('#editContentTimKerjaId').val();

    $.ajax({
        url: `/content/tim_kerja/update/${id}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            showAlert(response.message);
            location.reload(); // Refresh the page after the update
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
