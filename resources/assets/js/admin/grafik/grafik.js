'use strict';

$(function () {

  // buat input
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // Definisi warna dan properti yang digunakan
  const purpleColor = '#836AF9',
    yellowColor = '#ffe800',
    cyanColor = '#28dac6',
    orangeColor = '#FF8132',
    orangeLightColor = '#FDAC34',
    oceanBlueColor = '#299AFF',
    greyColor = '#4F5D70',
    greyLightColor = '#EDF1F4',
    blueColor = '#2B9AFF',
    blueLightColor = '#84D0FF';

  let cardColor, headingColor, labelColor, borderColor, legendColor;

  const chartList = document.querySelectorAll('.chartjs');
  chartList.forEach(function (chartListItem) {
    chartListItem.height = chartListItem.dataset.height;
  });

  var dt_scrollable_table = $('.dt-scrollableTable');

  // Ambil data dari server melalui AJAX
  $.ajax({
    url: '/grafik/data', // URL endpoint
    type: 'GET',
    success: function (response) {
      // Proses data yang diambil
      const labels = response.map((item, index) => `${index + 1}/${response.length}`); // Format label menjadi 1/--
      const dataValues = response.map(item => parseInt(item.jawaban)); // Ambil jawaban (konversi ke integer)

      // Buat Bar Chart dengan data dari server
      const barChart = document.getElementById('barChart');
      if (barChart) {
        const barChartVar = new Chart(barChart, {
          type: 'bar',
          data: {
            labels: labels, // Gunakan label 1/--
            datasets: [
              {
                data: dataValues, // Gunakan data dari server
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
                rtl: isRtl,
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
                  drawBorder: false,
                  borderColor: borderColor
                },
                ticks: {
                  color: labelColor
                }
              },
              y: {
                min: 0,
                max: Math.max(...dataValues) + 1, // Sesuaikan sumbu Y dengan data maksimum
                grid: {
                  color: borderColor,
                  drawBorder: false,
                  borderColor: borderColor
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

      // Buat tabel daftar pertanyaan di bawah grafik
      let tableHTML = '<table class="table table-bordered">';
      tableHTML += '<thead><tr><th>No</th><th>Pertanyaan</th></tr></thead><tbody>';
      response.forEach((item, index) => {
        tableHTML += `<tr><td>${index + 1}</td><td>${item.pertanyaan}</td></tr>`;
      });
      tableHTML += '</tbody></table>';

      // Masukkan tabel ke dalam elemen dengan id 'pertanyaanTable'
      $('#pertanyaanTable').html(tableHTML);
    },
    error: function (error) {
      console.error('Gagal mengambil data untuk grafik', error);
    }
  });
});
