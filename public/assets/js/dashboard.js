function getLast7Days() {
  var result = [];
  for (var i = 7; i >= 0; i--) {
      var date = new Date();
      date.setDate(date.getDate() - i);
      var formattedDate = date.toLocaleDateString('en-US', { day: '2-digit', month: '2-digit' });
      result.push(formattedDate);
  }
  return result;
}

$(document).ready(function () {
  var today, left1 = 0, left2 = 0, left3 = 0, left4 = 0, left5 = 0, left6 = 0, left7 = 0;
  var siswa = '{{ $siswa }}';

  $.get('/hitung-absen', function (data) {
      console.log(data);
      today = data.today;

      if (data.siswa) siswa = data.siswa;
      if (data.left1) left1 = data.left1;
      if (data.left2) left2 = data.left2;
      if (data.left3) left3 = data.left3;
      if (data.left4) left4 = data.left4;
      if (data.left5) left5 = data.left5;
      if (data.left6) left6 = data.left6;
      if (data.left7) left7 = data.left7;

      buatDanRenderChart(today, siswa);
  });

  function buatDanRenderChart(today, siswa) {
      var chartData = {
          series: [
              { name: "Jumlah Aktivitas Kehadiran ", data: [left7, left6, left5, left4, left3, left2, left1, today] },
          ],
          chart: {
              type: "bar",
              height: 345,
              offsetX: -15,
              toolbar: { show: true },
              foreColor: "#adb0bb",
              fontFamily: 'inherit',
              sparkline: { enabled: false },
          },
          colors: ["#206D47", "#24AD69"],
          plotOptions: {
              bar: {
                  horizontal: false,
                  columnWidth: "35%",
                  borderRadius: [6],
                  borderRadiusApplication: 'end',
                  borderRadiusWhenStacked: 'all'
              },
          },
          markers: { size: 0 },
          dataLabels: {
              enabled: false,
          },
          legend: {
              show: false,
          },
          grid: {
              borderColor: "rgba(0,0,0,0.1)",
              strokeDashArray: 3,
              xaxis: {
                  lines: {
                      show: false,
                  },
              },
          },
          xaxis: {
              type: "category",
              categories: getLast7Days(),
              labels: {
                  style: { cssClass: "grey--text lighten-2--text fill-color" },
              },
          },
          yaxis: {
              show: true,
              min: 0,
              max: siswa,
              tickAmount: 4,
              labels: {
                  style: {
                      cssClass: "grey--text lighten-2--text fill-color",
                  },
              },
          },
          stroke: {
              show: true,
              width: 3,
              lineCap: "butt",
              colors: ["transparent"],
          },
          tooltip: { theme: "light" },
          responsive: [
              {
                  breakpoint: 600,
                  options: {
                      plotOptions: {
                          bar: {
                              borderRadius: 3,
                          }
                      },
                  }
              }
          ]
      };

      var chart = new ApexCharts(document.querySelector("#chart"), chartData);
      chart.render();
  }
});
