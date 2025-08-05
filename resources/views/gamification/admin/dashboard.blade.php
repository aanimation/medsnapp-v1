<div>
	<!-- Navbar -->
	<!-- End Navbar -->
	<div class="container-fluid py-4">
		<div class="row">
			<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
				<div class="card">
					<div class="card-header p-3 pt-2">
						<div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
							<i class="material-icons opacity-10">weekend</i>
						</div>
						<div class="text-end pt-1">
							<p class="text-sm mb-0 text-capitalize">Today's Money</p>
							<h4 class="mb-0">€{{ $newTodayMoney }}.00</h4>
						</div>
					</div>
					<hr class="dark horizontal my-0">
					<div class="card-footer p-3">
						<p class="mb-0"><span class="text-success text-sm font-weight-bolder">+0% </span>than lask week</p>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
				<div class="card">
					<div class="card-header p-3 pt-2">
						<div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
							<i class="material-icons opacity-10">person</i>
						</div>
						<div class="text-end pt-1">
							<p class="text-sm mb-0 text-capitalize">Today's Users</p>
							<h4 class="mb-0">{{ $newUserTodayCount }}</h4>
						</div>
					</div>
					<hr class="dark horizontal my-0">
					<div class="card-footer p-3">
						<p class="mb-0"><span class="text-success text-sm font-weight-bolder">+0% </span>than yesterday</p>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
				<div class="card">
					<div class="card-header p-3 pt-2">
						<div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
							<i class="material-icons opacity-10">person</i>
						</div>
						<div class="text-end pt-1">
							<p class="text-sm mb-0 text-capitalize">Questions This Month</p>
							<h4 class="mb-0">{{ $newQuestionsCount }}</h4>
						</div>
					</div>
					<hr class="dark horizontal my-0">
					<div class="card-footer p-3">
						<p class="mb-0"><span class="text-success text-sm font-weight-bolder">+0%</span> than last month</p>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6">
					<div class="card">
							<div class="card-header p-3 pt-2">
									<div
											class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
											<i class="material-icons opacity-10">weekend</i>
									</div>
									<div class="text-end pt-1">
											<p class="text-sm mb-0 text-capitalize">Today's Patients</p>
											<h4 class="mb-0">{{ $userQuestTodayCount }}</h4>
									</div>
							</div>
							<hr class="dark horizontal my-0">
							<div class="card-footer p-3">
									<p class="mb-0"><span class="text-success text-sm font-weight-bolder">+0% </span>than yesterday</p>
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
							<h6 class="mb-0 ">New User Register</h6>
							<hr class="dark horizontal">
							<div class="d-flex ">
								<i class="material-icons text-sm my-auto me-1">schedule</i>
								<p class="mb-0 text-sm"> updated 2 minutes ago </p>
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
							<h6 class="mb-0 ">Daily Income</h6>
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
							<h6 class="mb-0 ">Completed Patient</h6>
							<hr class="dark horizontal">
							<div class="d-flex ">
								<i class="material-icons text-sm my-auto me-1">schedule</i>
								<p class="mb-0 text-sm">just updated</p>
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="row mb-4">
			<div class="col-12 h-100">
				<div class="card">
					<div class="card-header pb-0">
						<div class="row">
							<div class="col-lg-6 col-7">
								<h6>New Questions</h6>
								{{--
								<p class="text-sm mb-0">
									<i class="fa fa-check text-info" aria-hidden="true"></i>
									<span class="font-weight-bold ms-1">3 done</span> today
								</p>
								--}}
							</div>
							<div class="col-lg-6 col-5 my-auto text-end">&nbsp;</div>
						</div>
					</div>
					<div class="card-body px-0 pb-2">
						<div class="table-responsive">
							<table class="table align-items-center mb-0">
								<thead>
									<tr>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Question Vignitte</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Submitted</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									@foreach($questions as $item)
										<tr>
											<td>
												<p class="ms-3">{{ $item->title }}</p>
											</td>
											<td>
												<p>{{ $item->User->username }}</p>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold">{{ date('d-m Y H:i', strtotime($item->created_at)) }}</span>
											</td>
											<td class="align-middle text-center text-sm">
												<span class="text-xs font-weight-bold">
													{{ strtoupper($item->status) }}
												</span>
											</td>
											<td class="align-middle text-end">
												<a href="{{ route('question-review', $item->skey) }}" class="badge bg-gradient-secondary cursor-pointer"><i class="material-symbols-outlined text-xs p-0">visibility</i></a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

@push('js')
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>
	/* User Register */
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

	/* Income */
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

	/* Patient Completed */
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
