'use strict';

$(function () {

  // buat input
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  var dt_scrollable_table = $('.dt-scrollableTable');

  // Scrollable
  // --------------------------------------------------------------------

  if (dt_scrollable_table.length) {
    var dt_scrollableTable = dt_scrollable_table.DataTable({
      ajax: {
        url: '/hasil_survey/data', // ini ke web.php
        dataSrc: 'data' //  ini ke controller
      }, // 
      columns: [
        { 
          data: null, 
          title: 'No', 
          render: function (data, type, row, meta) {
            return meta.row + 1; // Menampilkan nomor urut berdasarkan index
          },
          orderable: false // Kolom ini tidak bisa diurutkan
        },
        { data: 'mahasiswa.nim', title: 'NIM' },
        { data: 'nama_kuesioner', title: 'Kuesioner' },
        { data: 'pertanyaan', title: 'Pertanyaan' },
        { data: 'jawaban', title: 'Jawaban' },
        { data: 'semester', title: 'Semester' },
        { 
          data: null, 
          title: 'Actions', 
          orderable: false, // Column cannot be sorted
          render: function (data, type, row) {
            return `
              <button class="btn btn-sm btn-primary edit-btn me-1" data-id="${row.id}" data-nama="${row.nama}" data-id-Jurusan="${row.jurusan.id}" data-nama-Jurusan="${row.jurusan.nama}">
                <i class="fas fa-edit"></i> 
              </button>
              <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">
                <i class="fas fa-trash"></i> 
              </button>
            `;
          }
        }
      ],
      orderCellsTop: true,
      dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      initComplete: function (settings, json) {
        // Add the mti-n1 class to the first row in tbody
        dt_scrollable_table.find('tbody tr:first').addClass('border-top-0');
      }
    });  

//     $('#editProdi').on('show.bs.modal', function (event) {
//       // Ambil tombol yang memicu modal
//       var button = $(event.relatedTarget); // Button yang men-trigger modal
      
//       // Ambil data dari tombol tersebut
//       var jurusanId = button.data('idJurusan'); 
//       console.log(button.data()); // Debug: Cek data yang diambil dari tombol
    
//       // AJAX untuk memuat data jurusan
//       $.ajax({
//         url: '/jurusan/data',
//         type: 'GET',
//         success: function (data) {
//           var jurusanSelect = $('#editJurusan'); // Pilihan dropdown jurusan
          
//           // Kosongkan dropdown sebelum mengisi data baru
//           jurusanSelect.empty();
//           jurusanSelect.append(`<option value="">Pilih Jurusan</option>`);
    
//           // Tambahkan data jurusan ke dalam dropdown
//           data.data.forEach(function (jurusan) {
//             jurusanSelect.append(`<option value="${jurusan.id}">${jurusan.nama}</option>`);
//           });
    
//           // Set value dropdown ke jurusan yang sedang dipilih
//           jurusanSelect.val(jurusanId); 
//         },
//         error: function (xhr) {
//           alert('Terjadi kesalahan dalam memuat data jurusan.');
//         }
//       });
//     });
    

    
//     // $('#editProdi').on('show.bs.modal', function (event) {  
//     //   var button = $(event.relatedTarget); // Button yang men-trigger modal
//     //   var jurusanId = button.data('idJurusan'); 
//     //   console.log(button.data());
//     //   $.ajax({
//     //     url: '/jurusan/data',
//     //     type: 'GET',
//     //     success: function (data) {
//     //       var jurusanSelect = $('#editJurusan'); // diisi id dari blade jurusan

//     //       console.log($(this).data('idJurusan')); // Debug: pastikan data muncul di console
//     //       // Looping untuk menambahkan data jurusan
//     //       data.data.forEach(function (jurusan) {
//     //         jurusanSelect.append(`<option value="${jurusan.id}">${jurusan.nama}</option>`);
//     //       });
          
    
//     //       // Set jurusan yang sedang dipilih
//     //       jurusanSelect.val(jurusanId); // Set jurusan yang dipilih berdasarkan data yang ada
//     //     },
//     //     error: function (xhr) {
//     //       alert('Terjadi kesalahan dalam memuat data jurusan.');
//     //     }
//     //   });
//     // });
//       // Function to show alert
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
  
  
//         // Handle edit button click
//         $(document).on('click', '.edit-btn', function () {
//           var id = $(this).data('id');
//           var nama = $(this).data('nama');
//           var id_jurusan = $(this).data('idJurusan');

//           console.log(id_jurusan);
          
//           // Set values in the edit modal
//           $('#editProdiId').val(id);
//           $('#editNama').val(nama);
//           $('#editJurusan').val(id_jurusan);
//           $('#editProdi').modal('show'); // Show the modal
//         });


//             // Handle form submission for editing jurusan
//         $('#editProdiForm').on('submit', function (e) {
//           e.preventDefault(); // Prevent the default form submission

//           var formData = $(this).serialize(); // Serialize form data
//           var id = $('#editProdiId').val(); // Get the ID

//           // AJAX request to submit the edit form data
//           $.ajax({
//             url: `/prodi/update/${id}`, // URL to your update method in the controller
//             type: 'PUT',
//             data: formData,
//             success: function (response) {
//               showAlert(response.message);
//               setTimeout(function() {
//                 location.reload(); // Refresh the page after a short delay
//               }, 2000);
//             },
//             error: function (xhr) {
//                handleError(xhr);
//             }
//           });
//         });

        
//         // Handle delete action
//         $(document).on('click', '.delete-btn', function () {
//           var id = $(this).data('id');
    
//           // Show SweetAlert2 confirmation dialog
//           Swal.fire({
//             title: 'Are you sure?',
//             text: "You won't be able to revert this!",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#d33',
//             cancelButtonColor: '#E3EBEA',
//             confirmButtonText: 'Yes, Delete',
//             cancelButtonText: 'Cancel'
//           }).then((result) => {
//             if (result.isConfirmed) {
//               // Perform AJAX DELETE request
//               $.ajax({
//                 url: `/prodi/delete/${id}`, // URL to your delete method in the controller
//                 type: 'DELETE',
//                 success: function (response) {
//                   // Refresh the DataTable after deletion
//                   dt_scrollableTable.ajax.reload();
//                   Swal.fire({
//                     icon: 'success',
//                     title: 'Deleted!',
//                     text: response.message,
//                     timer: 2000,
//                     showConfirmButton: false
//                   });
//                 },
//                 error: function (xhr) {
//                   if (xhr.responseJSON && xhr.responseJSON.message) {
//                     Swal.fire('Error!', xhr.responseJSON.message, 'error');
//                   } else {
//                     Swal.fire('Error!', 'An unexpected error occurred.', 'error');
//                   }
//                 }
//               });
//             }
//           });
//         });
  }
});
