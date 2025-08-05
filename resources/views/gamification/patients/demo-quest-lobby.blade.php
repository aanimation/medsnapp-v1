<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2">
		<div class="row mb-4">
			<div class="col-12">
				<div class="card">
					<div class="card-body p-3 pb-4">
						<h5 class="font-weight-normal">Patients</h5>
						<div class="row justify-content-center gy-3">
							<div class="col-6 col-lg-2 text-center">
								<div class="border border-dark border-1 border-radius-md py-1">
									<h6 class="text-warning text-gradient mb-0">Patient{{$totalPatient>1?'s':''}}</h6>
									<h5 class="font-weight-bolder mb-0"><span class="small">{{ $totalPatient }}</span></h5>
								</div>
							</div>
							<div class="col-6 col-lg-2 text-center">
								<div class="border border-dark border-1 border-radius-md py-1">
									<h6 class="text-success text-gradient mb-0">Success</h6>
									<h5 class="font-weight-bolder mb-0"><span class="small">{{ $successCount }}</span></h5>
								</div>
							</div>
							<div class="col-6 col-lg-2 text-center mt-sm-4">
								<div class="border border-dark border-1 border-radius-md py-1">
									<h6 class="text-danger text-gradient mb-0">Unsuccessful</h6>
									<h5 class="font-weight-bolder mb-0"><span class="small">{{ $failedCount }}</span></h5>
								</div>
							</div>
							<div class="col-6 col-lg-2 text-center mt-sm-4">
								<div class="border border-dark border-1 border-radius-md py-1">
									<h6 class="text-info text-gradient mb-0">Reputation Gained</h6>
									<h5 class="font-weight-bolder mb-0"><span class="small">{{ $sumReputation }}</span></h5>
								</div>
							</div>
						</div>

						<div class="row justify-content-center mt-4 mt-sm-3">
							<div class="w-lg-20 w-md-50 w-100 text-center mt-0 mt-sm-4">
								<div class="input-group input-group-static mb-4">
								<select wire:model.live="selectedCaseKey" class="form-control text-white">
									@foreach($allCases as $case)
									<option value="{{$case->skey}}">{{$case->type}}</option>
									@endforeach
								</select>
								</div>
							</div>
							<div class="w-lg-20 w-md-50 w-100 text-center mt-0 mt-sm-4">
								<button wire:click.prevent="startDemo" class="btn btn-lg bg-gradient-medsnapp text-white font-weight-bolder shadow w-100">Start</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end row -->

		@if($summary->where('updated_at', '!=', null)->count() > 0)
		<div class="row mt-4">
			<div class="col-12">
				<div class="card p-4 h-100">
					<div class="card-header pb-0 p-3 d-flex">
						<h6>Demo Summary</h6>
					</div>
					<div class="card-body px-0 pt-0 pb-2">
						<div class="table-responsive p-0">
							<table class="table table-striped align-items-center mb-0">
								<thead>
									<tr>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											No.
										</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											Date
										</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
											Case Name
										</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
											&nbsp;
										</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											&nbsp;
										</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									@foreach($summary->where('updated_at', '!=', null) as $item)
									<tr>
										<td>
											<p class="text-sm ps-3 font-weight-normal mb-0">{{ $loop->index + 1 }}.</p>
										</td>
										<td>
											<p class="text-sm font-weight-normal mb-0">{{ date("d M Y", strtotime($item->created_at)) }}</p>
										</td>
										<td>
											<p class="text-sm font-weight-normal mb-0">{{ strtoupper($item->Quest->type) }}</p>
										</td>
										<td colspan="2">&nbsp;</td>
										<td class="text-end">
											<button wire:click.prevent="resetDemo('{{$item->Quest->skey}}')" wire:loading.attr="disabled" class="btn btn-sm bg-gradient-medsnapp text-white my-0 px-5">Reset</button>
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
		@endif

	</div> <!-- end container -->
</div>

<script>
	document.addEventListener('openUpgradeOffers', (event) => {
		Swal.fire({
			title: "Great",
			text: "You still free access within limited features, MedSnapp has more features to explore, Check out this offers and kindly free to choose your plan.",
			imageUrl: "/assets/svg/ui/shop.svg",
			imageWidth: 60,
			imageHeight: 60,
			imageAlt: "shop",
			showCancelButton: false,
			showCloseButton: true,
			confirmButtonColor: "#8f4ce8",
			confirmButtonText: "Interested"
		})
		.then((result) => {
			if (result.isConfirmed) {
				window.open("{{route('subscription')}}", "_blank");}
		});
	});
</script>