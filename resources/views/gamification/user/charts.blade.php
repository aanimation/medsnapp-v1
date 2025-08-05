<div>

	<div class="row mt-4">
		<div class="col-lg-6 col-12">
			<div class="card">
				<div class="card-header pb-0 p-3 ps-4 pb-2">
					<h6 class="mb-0">Currencies</h6>
					<div class="d-flex align-items-center d-none">
						<span class="badge badge-md badge-dot me-4">
							<i class="bg-primary"></i>
							<span class="text-light text-xs">Your Questions</span>
						</span>
						<span class="badge badge-md badge-dot me-4">
							<i class="bg-dark"></i>
							<span class="text-light text-xs">Answered Questions</span>
						</span>
						<span class="badge badge-md badge-dot me-4">
							<i class="bg-info"></i>
							<span class="text-light text-xs">Unanswered Questions</span>
						</span>
					</div>
				</div>
				<div class="card-body p-3">
					<div class="chart">
						<canvas id="chart-line-top" class="chart-canvas" height="300" width="610" style="display: block; box-sizing: border-box; height: 300px; width: 610.2px;"></canvas>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-12">
			<div class="card h-100">
				<div class="card-header pb-0 p-3 ps-4 pb-4">
					<h6 class="mb-0">Patients</h6>
					<p class="mb-0 text-sm d-none">Sample chart</p>
				</div>
				<div class="card-body p-3 pt-0">
					<div class="chart">
						<canvas id="histogram-chart" class="chart-canvas" height="300" width="515" style="display: block; box-sizing: border-box; height: 300px; width: 515px;"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{--
	<div class="row mt-4 mb-5 mb-md-0">
		<div class="col-lg-6 col-12">
			<div class="card h-100 mt-4 mt-md-0">
				<div class="card-header pb-0 p-3 ps-4">
					<div class="d-flex align-items-center">
						<h6>Questions</h6>
					</div>
				</div>
				<div class="card-body px-3 pt-0 pb-2">
					<div class="table-responsive p-0">
						<table class="table align-items-center justify-content-center mb-0">
							<thead>
								<tr>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Column
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Column
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Column
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<p class="text-sm font-weight-normal mb-0">1. Questions title here</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">345</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">40.91%</p>
									</td>
								</tr>
								<tr>
									<td>
										<p class="text-sm font-weight-normal mb-0">2. Questions title here</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">520</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">30.14%</p>
									</td>
								</tr>
								<tr>
									<td>
										<p class="text-sm font-weight-normal mb-0">3. Questions title here</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">122</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">54.10%</p>
									</td>
								</tr>
								<tr>
									<td>
										<p class="text-sm font-weight-normal mb-0">4. Questions title here</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">1,900</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">20.93%</p>
									</td>
								</tr>
								<tr>
									<td>
										<p class="text-sm font-weight-normal mb-0">5. Questions title here</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">1,442</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">34.98%</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-12">
			<div class="card h-100 mb-4">
				<div class="card-header pb-0 p-3 ps-4">
					<h6>Top 3 Answer Your Questions</h6>
				</div>
				<div class="card-body px-0 pt-0 pb-2">
					<div class="table-responsive p-0">
						<table class="table align-items-center mb-0">
							<thead>
								<tr>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										User
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Value
									</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										Value
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="d-flex px-3 py-1">
											<div>
												<div class="avatar me-3" alt="avatar image">
													<span class="material-symbols-outlined">person_check</span>
												</div>
											</div>
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-sm">Alice Vinget</h6>
												<p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success font-weight-bold">8</span> exps</p>
											</div>
										</div>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">rank</p>
									</td>
									<td class="align-middle text-end">
										<div class="d-flex px-3 py-1 justify-content-center align-items-center">
											<p class="text-sm font-weight-normal mb-0">level</p>
											<i
												class="material-icons ms-1 mt-1 text-success opacity-10"
												aria-hidden="true"
												data-bs-toggle="tooltip"
												data-bs-placement="bottom"
												title=""
												data-bs-original-title="Refund rate is lower with 97% than other users"
											>
												expand_less
											</i>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex px-3 py-1">
											<div>
												<div class="avatar me-3" alt="avatar image">
													<span class="material-symbols-outlined">person_check</span>
												</div>
											</div>
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-sm">John Alura</h6>
												<p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success font-weight-bold">12</span> exps</p>
											</div>
										</div>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">rank</p>
									</td>
									<td class="align-middle text-end">
										<div class="d-flex px-3 py-1 justify-content-center align-items-center">
											<p class="text-sm font-weight-normal mb-0">level</p>
											<i class="material-icons ms-1 mt-1 text-success opacity-10" aria-hidden="true">expand_less</i>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex px-3 py-1">
											<div>
												<div class="avatar me-3" alt="avatar image">
													<span class="material-symbols-outlined">person_check</span>
												</div>
											</div>
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-sm">Andrew Sian</h6>
												<p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success font-weight-bold">24</span> exps</p>
											</div>
										</div>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">rank</p>
									</td>
									<td class="align-middle text-end">
										<div class="d-flex px-3 py-1 justify-content-center align-items-center">
											<p class="text-sm font-weight-normal mb-0">level</p>
											<i class="material-icons ms-1 mt-1 text-danger opacity-10" aria-hidden="true">expand_more</i>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row mt-4">
		<div class="col-lg-6 col-12">
			<div class="card z-index-2 mt-4">
				<div class="card-header p-3 pt-2">
					<div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 me-3 float-start">
						<i class="material-icons opacity-10">donut_small</i>
					</div>
					<h6 class="mb-0">Doughnut chart</h6>
					<p class="mb-0 text-sm">Sample program</p>
				</div>
				<div class="card-body d-flex p-3 pt-0">
					<div class="chart w-50">
						<canvas id="doughnut-chart" class="chart-canvas" height="304" width="257" style="display: block; box-sizing: border-box; height: 304px; width: 257.5px;"></canvas>
					</div>
					<div class="table-responsive w-50">
						<table class="table align-items-center mb-0">
							<tbody>
								<tr>
									<td>
										<div class="d-flex px-2 py-1">
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-sm">Data 1</h6>
											</div>
										</div>
									</td>
									<td class="align-middle text-center text-sm">
										<span class="text-xs font-weight-bold"> 25% </span>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex px-2 py-1">
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-sm">Data 2</h6>
											</div>
										</div>
									</td>
									<td class="align-middle text-center text-sm">
										<span class="text-xs font-weight-bold"> 13% </span>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex px-2 py-1">
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-sm">Data 3</h6>
											</div>
										</div>
									</td>
									<td class="align-middle text-center text-sm">
										<span class="text-xs font-weight-bold"> 12% </span>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex px-2 py-1">
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-sm">Data 4</h6>
											</div>
										</div>
									</td>
									<td class="align-middle text-center text-sm">
										<span class="text-xs font-weight-bold"> 37% </span>
									</td>
								</tr>
								<tr>
									<td>
										<div class="d-flex px-2 py-1">
											<div class="d-flex flex-column justify-content-center">
												<h6 class="mb-0 text-sm">Data 5</h6>
											</div>
										</div>
									</td>
									<td class="align-middle text-center text-sm">
										<span class="text-xs font-weight-bold"> 13% </span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-12 mt-md-0 mt-4">
			<div class="card z-index-2 mt-4">
				<div class="card-header p-3 pt-2">
					<div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 me-3 float-start">
						<i class="material-icons opacity-10">pie_chart</i>
					</div>
					<h6 class="mb-0">Pie chart</h6>
					<p class="mb-0 text-sm">Analytics Sample</p>
				</div>
				<div class="card-body d-flex p-3 pt-0">
					<div class="chart w-50">
						<canvas id="pie-chart" class="chart-canvas" height="304" width="257" style="display: block; box-sizing: border-box; height: 304.5px; width: 257.5px;"></canvas>
					</div>
					<div class="w-50 my-auto ms-5">
						<span class="badge badge-lg badge-dot me-4 d-block text-start">
							<i class="bg-info"></i>
							<span class="text-light">Examinations</span>
						</span>
						<span class="badge badge-lg badge-dot me-4 d-block text-start">
							<i class="bg-primary"></i>
							<span class="text-light">Investigations</span>
						</span>
						<span class="badge badge-lg badge-dot me-4 d-block text-start">
							<i class="bg-dark"></i>
							<span class="text-light">Treatments</span>
						</span>
						<span class="badge badge-lg badge-dot me-4 d-block text-start">
							<i class="bg-secondary"></i>
							<span class="text-light">Answered</span>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-4">
	  <div class="col-lg-4 col-md-6 mt-4 mb-4">
		  <div class="card z-index-2 ">
			  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
				  <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
					  <div class="chart">
						  <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
					  </div>
				  </div>
			  </div>
			  <div class="card-body">
				  <h6 class="mb-0 ">Bar Chart</h6>
				  <p class="text-sm ">Description</p>
				  <hr class="dark horizontal">
				  <div class="d-flex ">
					  <i class="material-icons text-sm my-auto me-1">schedule</i>
					  <p class="mb-0 text-sm"> sample updated 2 days ago </p>
				  </div>
			  </div>
		  </div>
	  </div>
	  <div class="col-lg-4 col-md-6 mt-4 mb-4">
		  <div class="card z-index-2  ">
			  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
				  <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
					  <div class="chart">
						  <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
					  </div>
				  </div>
			  </div>
			  <div class="card-body">
				  <h6 class="mb-0 "> Line Chart </h6>
				  <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today experiences. </p>
				  <hr class="dark horizontal">
				  <div class="d-flex ">
					  <i class="material-icons text-sm my-auto me-1">schedule</i>
					  <p class="mb-0 text-sm"> updated 4 min ago </p>
				  </div>
			  </div>
		  </div>
	  </div>
	  <div class="col-lg-4 mt-4 mb-3">
		  <div class="card z-index-2 ">
			  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
				  <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
					  <div class="chart">
						  <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
					  </div>
				  </div>
			  </div>
			  <div class="card-body">
				  <h6 class="mb-0 ">Dark Line Chart</h6>
				  <p class="text-sm ">Sample chart</p>
				  <hr class="dark horizontal">
				  <div class="d-flex ">
					  <i class="material-icons text-sm my-auto me-1">schedule</i>
					  <p class="mb-0 text-sm">just updated</p>
				  </div>
			  </div>
		  </div>
	  </div>
	</div>
	--}}

</div>

@push('js')
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>

	var ctx1 = document.getElementById("chart-line-top").getContext("2d");

  var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

  gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
  gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

  var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);

  gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
  gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

  // Line chart
  new Chart(ctx1, {
      type: "line",
      data: {
          labels: ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5", "Day 6", "Day 7", "Day 8", "Day 9"],
          datasets: [{
                  label: "Coins",
                  tension: 0.4,
                  borderWidth: 0,
                  pointRadius: 2,
                  pointBackgroundColor: "#e1b530",
                  borderColor: "#e1b530",
                  borderWidth: 3,
                  backgroundColor: gradientStroke1,
                  data: [100, 80, 85, 90, 80, 60, 50, 40, 20],
                  maxBarThickness: 6
              },
              {
                  label: "Energy",
                  tension: 0.4,
                  borderWidth: 0,
                  pointRadius: 2,
                  pointBackgroundColor: "#29c677",
                  borderColor: "#29c677",
                  borderWidth: 3,
                  backgroundColor: gradientStroke2,
                  data: [100, 96, 90, 88, 86, 85, 81, 79, 77],
                  maxBarThickness: 6
              },
              {
                  label: "Exp",
                  tension: 0.4,
                  borderWidth: 0,
                  pointRadius: 2,
                  pointBackgroundColor: "#17c1e8",
                  borderColor: "#17c1e8",
                  borderWidth: 3,
                  backgroundColor: gradientStroke2,
                  data: [0, 10, 25, 30, 35, 40, 50, 70, 120],
                  maxBarThickness: 6
              },
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
                      borderDash: [5, 5]
                  },
                  ticks: {
                      display: true,
                      padding: 10,
                      color: '#9ca2b7'
                  }
              },
              x: {
                  grid: {
                      drawBorder: false,
                      display: true,
                      drawOnChartArea: true,
                      drawTicks: true,
                      borderDash: [5, 5]
                  },
                  ticks: {
                      display: true,
                      color: '#9ca2b7',
                      padding: 10
                  }
              },
          },
      },
  });

  // Mixed chart
    var ctx7 = document.getElementById("histogram-chart").getContext("2d");

    new Chart(ctx7, {
        data: {
            labels: ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5", "Day 6", "Day 7", "Day 8", "Day 9"],
            datasets: [{
                    type: "bar",
                    label: "Patients Treated",
                    weight: 5,
                    tension: 0.4,
                    borderWidth: 0,
                    pointBackgroundColor: "#3A416F",
                    borderColor: "#3A416F",
                    backgroundColor: '#8a49e1',
                    borderRadius: 4,
                    borderSkipped: false,
                    data: [2, 2, 3, 2, 4, 2, 2, 4, 4],
                    maxBarThickness: 10,
                },
                {
                    type: "line",
                    label: "Treatments",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    pointBackgroundColor: "#e91e63",
                    borderColor: "#e91e63",
                    borderWidth: 3,
                    backgroundColor: "transparent",
                    data: [6, 5, 31, 23, 51, 26, 41, 24, 40],
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


	// Doughnut chart
    var ctx3 = document.getElementById("doughnut-chart").getContext("2d");

    new Chart(ctx3, {
        type: "doughnut",
        data: {
            labels: ['Data 1', 'Data 2', 'Data 3', 'Data 3', 'Data 4'],
            datasets: [{
                label: "Projects",
                weight: 9,
                cutout: 60,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ['#03A9F4', '#3A416F', '#fb8c00', '#8a49e1', '#e91e63'],
                data: [15, 20, 12, 60, 20],
                fill: false
            }],
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
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: false,
                    }
                },
            },
        },
    });

    // Pie chart
    var ctx4 = document.getElementById("pie-chart").getContext("2d");

    new Chart(ctx4, {
        type: "pie",
        data: {
            labels: ['Examinations', 'Investigations', 'Treatments', 'Answered'],
            datasets: [{
                label: "Projects",
                weight: 9,
                cutout: 0,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ['#03A9F4', '#e91e63', '#3A416F', '#8a49e1'],
                data: [15, 20, 12, 60],
                fill: false
            }],
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
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: false
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                    },
                    ticks: {
                        display: false,
                    }
                },
            },
        },
    });


  var ctx = document.getElementById("chart-bars").getContext("2d");

  new Chart(ctx, {
	  type: "bar",
	  data: {
		  labels: ["M", "T", "W", "T", "F", "S", "S"],
		  datasets: [{
			  label: "Sales",
			  tension: 0.4,
			  borderWidth: 0,
			  borderRadius: 4,
			  borderSkipped: false,
			  backgroundColor: "rgba(255, 255, 255, .8)",
			  data: [50, 20, 10, 22, 50, 10, 40],
			  maxBarThickness: 6
		  }, ],
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
					  color: 'rgba(255, 255, 255, .2)'
				  },
				  ticks: {
					  suggestedMin: 0,
					  suggestedMax: 500,
					  beginAtZero: true,
					  padding: 10,
					  font: {
						  size: 14,
						  weight: 300,
						  family: "Roboto",
						  style: 'normal',
						  lineHeight: 2
					  },
					  color: "#fff"
				  },
			  },
			  x: {
				  grid: {
					  drawBorder: false,
					  display: true,
					  drawOnChartArea: true,
					  drawTicks: false,
					  borderDash: [5, 5],
					  color: 'rgba(255, 255, 255, .2)'
				  },
				  ticks: {
					  display: true,
					  color: '#f8f9fa',
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


  var ctx2 = document.getElementById("chart-line").getContext("2d");

  new Chart(ctx2, {
	  type: "line",
	  data: {
		  labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		  datasets: [{
			  label: "Mobile apps",
			  tension: 0,
			  borderWidth: 0,
			  pointRadius: 5,
			  pointBackgroundColor: "rgba(255, 255, 255, .8)",
			  pointBorderColor: "transparent",
			  borderColor: "rgba(255, 255, 255, .8)",
			  borderColor: "rgba(255, 255, 255, .8)",
			  borderWidth: 4,
			  backgroundColor: "transparent",
			  fill: true,
			  data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
			  maxBarThickness: 6

		  }],
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
					  color: 'rgba(255, 255, 255, .2)'
				  },
				  ticks: {
					  display: true,
					  color: '#f8f9fa',
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
			  x: {
				  grid: {
					  drawBorder: false,
					  display: false,
					  drawOnChartArea: false,
					  drawTicks: false,
					  borderDash: [5, 5]
				  },
				  ticks: {
					  display: true,
					  color: '#f8f9fa',
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

  var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

  new Chart(ctx3, {
	  type: "line",
	  data: {
		  labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		  datasets: [{
			  label: "Mobile apps",
			  tension: 0,
			  borderWidth: 0,
			  pointRadius: 5,
			  pointBackgroundColor: "rgba(255, 255, 255, .8)",
			  pointBorderColor: "transparent",
			  borderColor: "rgba(255, 255, 255, .8)",
			  borderWidth: 4,
			  backgroundColor: "transparent",
			  fill: true,
			  data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
			  maxBarThickness: 6

		  }],
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
					  color: 'rgba(255, 255, 255, .2)'
				  },
				  ticks: {
					  display: true,
					  padding: 10,
					  color: '#f8f9fa',
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
					  display: false,
					  drawOnChartArea: false,
					  drawTicks: false,
					  borderDash: [5, 5]
				  },
				  ticks: {
					  display: true,
					  color: '#f8f9fa',
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