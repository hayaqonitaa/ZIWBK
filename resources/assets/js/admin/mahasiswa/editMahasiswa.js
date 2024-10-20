// 'use strict';

// $(function () {
//   // Handle edit button click
//   $(document).on('click', '.edit-btn', function () {
//     var NIM = $(this).data('nim');
//     var nama = $(this).data('nama');
//     var prodi = $(this).data('prodi');
//     var email = $(this).data('email');
    
//     $('#editNIM').val(NIM);
//     $('#editNama').val(nama);
//     $('#editProdi').val(prodi);
//     $('#editEmail').val(email);
//   });

  
//   // Handle form submission for editing Prodi
//   $('#editMahasiswaForm').on('submit', function (e) {
//     e.preventDefault(); // Prevent the default form submission

//     var formData = $(this).serialize(); // Serialize form data
//     var id = $('#editMahasiswaId').val(); // Get the ID

//     // AJAX request to submit the edit form data
//     $.ajax({
//       url: `/mahasiswa/update/${id}`, // URL to your update method in the controller
//       type: 'PUT',
//       data: formData,
//       success: function (response) {
//         showAlert(response.message);
//         setTimeout(function() {
//           location.reload(); // Refresh the page after a short delay
//         }, 2000);
//       },
//       error: function (xhr) {
//         handleError(xhr);
//       }
//     });
//   });
  
//   // Function to show alert
//   function showAlert(message) {
//     var alertDiv = $(`
//       <div class="alert alert-success" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
//         <i class="fas fa-check-circle me-2"></i>
//         <div>${message}</div>
//       </div>
//     `);
//     $('body').append(alertDiv);
//     setTimeout(function() {
//       alertDiv.fadeOut('slow', function() {
//         $(this).remove(); // Remove alert after fade out
//       });
//     }, 3000);
//   }

//   // Function to handle errors
//   function handleError(xhr) {
//     if (xhr.responseJSON && xhr.responseJSON.message) {
//       alert('Error: ' + xhr.responseJSON.message);
//     } else {
//       alert('An unexpected error occurred.');
//     }
//   }
// });
