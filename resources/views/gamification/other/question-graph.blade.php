
	<div class="col-lg-6 col-12">
		<div class="card h-100">
			<div class="card-header pb-0 p-3 ps-4 pb-4">
				<h6 class="mb-0">Questions</h6>
			</div>
			<div class="card-body p-3 pt-0">
				<div class="chart">
					<canvas id="bell-chart" class="chart-canvas" height="300" width="515" style="display: block; box-sizing: border-box; height: 300px; width: 515px;"></canvas>
				</div>
			</div>
		</div>
	</div>


@push('js')
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>
  var ctx8 = document.getElementById("bell-chart").getContext("2d");
  new Chart(ctx8, {
      data: {
          labels: ["0%", "10%", "20%", "30%", "40%", "50%", "60%", "70%", "80%", "90%", "100%"],
          datasets: [{
                  type: "bar",
                  label: "Correct",
                  weight: 5,
                  tension: 0.4,
                  borderWidth: 0,
                  pointBackgroundColor: "#3A416F",
                  borderColor: "#3A416F",
                  backgroundColor: '#8a49e1',
                  borderRadius: 4,
                  borderSkipped: false,
                  data: [0,2,10,23,44,49,44,23,10,2,0],
                  maxBarThickness: 10,
              },
              {
                  type: "line",
                  label: "Questions",
                  tension: 0.4,
                  borderWidth: 0,
                  pointRadius: 0,
                  pointBackgroundColor: "#e91e63",
                  borderColor: "#e91e63",
                  borderWidth: 3,
                  backgroundColor: "transparent",
                  data: [0,3,11,25,45,50,45,25,11,3,0],
                  fill: true,
              }
          ],
      },
      options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
              legend: {
                  display: false,
              }
          },
          interaction: {
              intersect: false,
              mode: 'index',
          },
          scales: {
              y: {
                  grid: {
                      drawBorder: false,
                      display: true,
                      drawOnChartArea: true,
                      drawTicks: false,
                      borderDash: [5, 5],
                      color: '#c1c4ce5c'
                  },
                  ticks: {
                      display: true,
                      padding: 10,
                      color: '#b2b9bf',
                      font: {
                          size: 14,
                          weight: 300,
                          family: "Roboto",
                          style: 'normal',
                          lineHeight: 2
                      },
                  }
              },
              x: {
                  grid: {
                      drawBorder: false,
                      display: true,
                      drawOnChartArea: true,
                      drawTicks: true,
                      borderDash: [5, 5],
                      color: '#c1c4ce5c'
                  },
                  ticks: {
                      display: true,
                      color: '#b2b9bf',
                      padding: 10,
                      font: {
                          size: 14,
                          weight: 300,
                          family: "Roboto",
                          style: 'normal',
                          lineHeight: 2
                      },
                  }
              },
          },
      },
  });
</script>
@endpush