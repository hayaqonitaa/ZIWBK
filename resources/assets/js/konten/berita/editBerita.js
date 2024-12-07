'use strict';

$(document).ready(function () {
    // Edit button click event
    $(document).on('click', '.edit-btn', function () {
        var button = $(this);
        var id = button.data('id');
        
        // Set form fields with existing data
        $('#editContentBeritaId').val(id);
        $('#editJudul').val(button.data('judul'));
        $('#editDeskripsi').val(button.data('deskripsi'));

        // Show current file name and preview
        var file = button.data('file');
        if (file) {
            var fileName = file.split('/').pop(); // Extract the file name
            $('#currentFile').text(fileName); // Display file name
            $('#currentFileImage').attr('src', `/storage/${file}`).show(); // Show image preview
        } else {
            $('#currentFile').text('No file uploaded');
            $('#currentFileImage').hide(); // Hide image preview if no file exists
        }

        // Set and display current status
        var currentStatus = button.data('status');
        $('#currentStatus').text(currentStatus); // Display status
        $('#editStatus').val(currentStatus); // Set status dropdown value

        // Open the modal
        $('#editContentBerita').modal('show');
    });

    // Form submission for editing content
    $('#editContentBeritaForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        var id = $('#editContentBeritaId').val();

        $.ajax({
            url: `/content/berita/update/${id}`, // Update endpoint
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from overriding the content type
            success: function (response) {
                showAlert(response.message);

                // Reload DataTable or refresh the page after the update
                $('#editContentBerita').modal('hide');
                location.reload(); // Refresh the entire page
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

    // Handle AJAX errors
    function handleError(xhr) {
        if (xhr.responseJSON && xhr.responseJSON.message) {
            alert('Error: ' + xhr.responseJSON.message);
        } else {
            alert('An unexpected error occurred.');
        }
    }
});
