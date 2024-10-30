'use strict';

$(document).on('click', '.delete-btn', function () {
    var id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#E3EBEA',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/content/agen_perubahan/delete/${id}?_=${new Date().getTime()}`,
                type: 'DELETE',
                success: function (response) {
                    console.log(response);
                    Swal.fire('Deleted!', response.message, 'success').then(() => {
                        dt_scrollableTable.ajax.reload(null, false); // Prevent pagination reset
                    });
                },
                error: function (xhr) {
                    console.error(xhr); // Log any errors
                    Swal.fire('Error!', 'An unexpected error occurred.', 'error');
                }
            });
        }
    });
});


