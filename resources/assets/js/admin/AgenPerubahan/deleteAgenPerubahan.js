'use strict';

$(function () {
  // Handle delete action
  $(document).on('click', '.delete-btn', function () {
    var id = $(this).data('id');

    // Show SweetAlert2 confirmation dialog
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Anda tidak akan dapat mengembalikannya!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#E3EBEA',
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Perform AJAX DELETE request
        $.ajax({
          url: `/agen-perubahan/delete/${id}`, // URL to your delete method in the controller
          type: 'DELETE',
          success: function (response) {
            Swal.fire({
              icon: 'success',
              title: 'Dihapus!',
              text: response.message,
              timer: 2000,
              showConfirmButton: false
            });
            // Refresh the DataTable after deletion
            $('.dt-scrollableTable').DataTable().ajax.reload();
          },
          error: function (xhr) {
            if (xhr.responseJSON && xhr.responseJSON.message) {
              Swal.fire('Error!', xhr.responseJSON.message, 'error');
            } else {
              Swal.fire('Error!', 'Terjadi kesalahan yang tidak terduga.', 'error');
            }
          }
        });
      }
    });
  });
});
