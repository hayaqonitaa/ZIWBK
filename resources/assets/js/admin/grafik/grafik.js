'use strict';

$(function () {
  // Setup CSRF Token untuk AJAX
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // Definisi warna
  const cyanColor = '#68adce',
    cardColor = '#fff',
    borderColor = '#ddd',
    labelColor = '#666',
    headingColor = '#333',
    legendColor = '#666';

  // Menyesuaikan tinggi chart berdasarkan data-height
  const chartList = document.querySelectorAll('.chartjs');
  chartList.forEach(function (chartListItem) {
    chartListItem.height = chartListItem.dataset.height;
  });

  // Variabel untuk menyimpan instance chart
  let barChartInstance = null;

  // Fungsi untuk menghitung rata-rata
  function hitungRataRata(data) {
    const groupedData = data.reduce((acc, item) => {
      if (!acc[item.pertanyaan]) {
        acc[item.pertanyaan] = { total: 0, count: 0 };
      }
      acc[item.pertanyaan].total += parseInt(item.jawaban, 10); // Jumlahkan jawaban
      acc[item.pertanyaan].count += 1; // Tambah jumlah data
      return acc;
    }, {});

    // Hitung rata-rata dan buat array hasil
    return Object.keys(groupedData).map(key => ({
      pertanyaan: key,
      rataRata: (groupedData[key].total / groupedData[key].count).toFixed(2) // Hitung rata-rata
    }));
  }

  // Fungsi untuk mengambil data berdasarkan tahun yang dipilih
  function loadData(tahun) {
    $.ajax({
      url: '/grafik/data/' + tahun, // Kirim tahun yang dipilih ke URL
      type: 'GET',
      success: function (response) {
        // Hitung rata-rata berdasarkan jawaban
        const rataRataData = hitungRataRata(response);

        // Data untuk grafik
        const totalPertanyaan = rataRataData.length; // Total jumlah pertanyaan
        const labels = rataRataData.map((item, index) => `${index + 1}/${totalPertanyaan}`); // Format label 1/-- (misalnya 1/5, 2/5, dll.)
        const dataValues = rataRataData.map(item => item.rataRata);

        if (barChartInstance) {
          barChartInstance.destroy();
        }

        // Buat grafik
        const barChart = document.getElementById('barChart');
        if (barChart) {
          barChartInstance = new Chart(barChart, {
            type: 'bar',
            data: {
              labels: labels, // Gunakan format 1/--
              datasets: [
                {
                  data: dataValues, // Rata-rata sebagai data
                  backgroundColor: cyanColor,
                  borderColor: 'transparent',
                  maxBarThickness: 15,
                  borderRadius: {
                    topRight: 15,
                    topLeft: 15
                  }
                }
              ]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              animation: {
                duration: 500
              },
              plugins: {
                tooltip: {
                  backgroundColor: cardColor,
                  titleColor: headingColor,
                  bodyColor: legendColor,
                  borderWidth: 1,
                  borderColor: borderColor
                },
                legend: {
                  display: false
                }
              },
              scales: {
                x: {
                  grid: {
                    color: borderColor,
                    drawBorder: false
                  },
                  ticks: {
                    color: labelColor
                  }
                },
                y: {
                  min: 0,
                  max: Math.ceil(Math.max(...dataValues)), // Sesuaikan sumbu Y dengan data maksimum
                  grid: {
                    color: borderColor,
                    drawBorder: false
                  },
                  ticks: {
                    stepSize: 1,
                    color: labelColor
                  }
                }
              }
            }
          });
        }

        // Buat tabel daftar pertanyaan dan rata-rata di bawah grafik
        let tableHTML = '<table class="table table-bordered">';
        tableHTML += '<thead><tr><th>No</th><th>Pertanyaan</th><th>Rata-rata</th></tr></thead><tbody>';
        rataRataData.forEach((item, index) => {
          tableHTML += `<tr><td>${index + 1}</td><td>${item.pertanyaan}</td><td>${item.rataRata}</td></tr>`;
        });
        tableHTML += '</tbody></table>';

        $('#pertanyaanTable').html(tableHTML);
      },
      error: function (error) {
        console.error('Gagal mengambil data untuk grafik', error);
      }
    });
  }

  let currentYear = new Date().getFullYear();

  loadData(currentYear);

  // Panggil fungsi loadData saat tahun dipilih di dropdown
  $('#filterTahun').change(function () {
    var selectedTahun = $(this).val();

    // Cek jika ada tahun yang dipilih
    if (selectedTahun) {
      loadData(selectedTahun);
      console.log(selectedTahun);
    }
  });
});
