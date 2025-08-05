<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2 px-sm-2 px-xl-4 px-xxl-12">
		<div class="row mb-4">
			<div class="col-12">
				<div class="card card-body with-border p-3 pb-4">
					<h5 class="font-weight-normal">Patients</h5>
					<div class="row justify-content-center gy-3">
						<div class="col-6 col-lg-2 text-center">
							<div class="border border-dark border-1 border-radius-md py-3">
								<h6 class="text-warning text-gradient mb-0">Patient{{$totalPatient>1?'s':''}}</h6>
								<h5 class="font-weight-bolder mb-0"><span class="small">{{ $totalPatient }}</span></h5>
							</div>
						</div>
						<div class="col-6 col-lg-2 text-center">
							<div class="border border-dark border-1 border-radius-md py-3">
								<h6 class="text-success text-gradient mb-0">Success</h6>
								<h5 class="font-weight-bolder mb-0"><span class="small">{{ $successCount }}</span></h5>
							</div>
						</div>
						<div class="col-6 col-lg-2 text-center mt-sm-4">
							<div class="border border-dark border-1 border-radius-md py-3">
								<h6 class="text-danger text-gradient mb-0">Unsuccessful</h6>
								<h5 class="font-weight-bolder mb-0"><span class="small">{{ $failedCount }}</span></h5>
							</div>
						</div>
						<div class="col-6 col-lg-2 text-center mt-sm-4">
							<div class="border border-dark border-1 border-radius-md py-3">
								<h6 class="text-info text-gradient mb-0">Reputation</h6>
								<h5 class="font-weight-bolder mb-0"><span class="small">{{ $sumReputation }}</span></h5>
							</div>
						</div>
					</div>

					<div class="row justify-content-center mt-4 mt-sm-3">
						@if($unfinished)
							<div class="w-sm-40 w-md-50 w-lg-20 text-center mt-0 mt-sm-4">
								<button wire:click.prevent="resume({{ $unfinished->id }})" class="btn btn-lg bg-gradient-medsnapp text-white font-weight-bolder shadow w-100">Resume<span wire:loading wire:target="resume" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
							</div>
						@else
							<div class="w-sm-50 w-md-50 w-lg-20 text-center mt-sm-2 {{session()->has('next-route-num') ? 'd-none' : ''}}">
								<a href="{{ route('shop') }}" class="btn btn-lg bg-gradient-dark text-white font-weight-bolder shadow w-100"><img width="20" height="auto" src="/assets/svg/ui/shop.svg" alt="shop"/> Shop</a>
							</div>
							<div class="w-sm-50 w-md-50 w-lg-20 text-center mt-0 mt-sm-2">
								<!-- Pre Start for Upgrade -->
								<button wire:click.prevent="preStart" class="btn btn-lg bg-gradient-medsnapp text-white font-weight-bolder shadow w-100">New Patient<span wire:loading wire:target="preStart" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div> <!-- end row -->

		@include('gamification.parts.top-tip')

		@isset($summary)
		<div class="row mt-4 min-height-300 mb-2">
			<div class="col-12">
				<div class="card card-body with-border px-2 pt-0 pb-2 h-100">
					<div class="pb-0 p-3 d-flex">
						<div class="w-60">
							<h5 class="font-weight-normal">Summary</h5>
						</div>
						<div wire:loading wire:target="retry" class="w-40 text-end">
							<h6 class="text-warning">Preparing data..</h6>
						</div>
					</div>
					<div class="text-center {{ $summary->count() ? 'd-none' : '' }}">Assess and treat your first patient to see your data.</div>
					<div class="table-responsive p-0 {{ $summary->count() ? '' : 'd-none' }}">
						<table class="table table-striped align-items-center mb-0">
							<thead>
								<tr>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										No.
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Date
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Patient
									</th>
									<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Duration
									</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										Revived
									</th>
									<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
										Reputation
									</th>
									<th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
										Result
									</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@foreach($summary as $item)
								<tr>
									<td>
										<p class="text-sm ps-3 font-weight-normal mb-0">{{ $loop->index + 1 }}.</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">{{ date("d M Y", strtotime($item->created_at)) }}</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">{{ $item->Quest->name }}</p>
									</td>
									<td class="align-middle text-start text-sm">
										<p class="text-sm font-weight-normal mb-0">
											@if($item->finished_at)
												@php
													$__diff = intdiv($item->created_at->diffInSeconds($item->finished_at), 60);
												@endphp
												<span class="small">{{ $__diff > 60 ? '>1 hour' : $__diff.' minutes' }}</span>
											@else
												In Progress
											@endif
										</p>
									</td>
									<td>
										<p class="align-middle text-center text-sm font-weight-normal mb-0">{{ $item->is_revived ? 'Yes' : (is_null($item->reputation) ? 'In Progress' : 'No')
										}}</p>
									</td>
									<td class="align-middle text-center text-sm">
										<p class="text-sm font-weight-normal mb-0">{{ $item->reputation ?? 'In Progress' }}</p>
									</td>
									<td>
										<p class="text-center text-sm font-weight-normal mb-0">{{ $item->reputation > 0 ? 'Success' : (is_null($item->reputation) ? 'In Progress' : 'Unsuccessful') }}</p>
									</td>
									<td>
										@if($item->amount <= 0)
										<button wire:click.prevent="retry({{$item->id}})" wire:loading.attr="disabled" class="btn btn-sm bg-gradient-medsnapp text-white my-0 {{ is_null($item->reputation) || $item->reputation > 0 ? 'd-none' : ''}}">Retry</button>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@endisset

	</div> <!-- end container -->
</div>

<script>
	document.addEventListener('openUpgradeOffers', (event) => {
		Swal.fire({
			title: "Unlock Full Access to MedSnapp! 🔓",
			text: "You’ve reached your free trial limit. Upgrade now to continue accessing MedSnapp’s full features and take your learning to the next level!",
			imageUrl: "/assets/svg/ui/shop.svg",
			imageWidth: 60,
			imageHeight: 60,
			imageAlt: "shop",
			showCancelButton: false,
			showCloseButton: true,
			confirmButtonColor: "#8f4ce8",
			confirmButtonText: "Upgrade Now"
		})
		.then((result) => {
			if (result.isConfirmed) {
				window.open("{{route('subscription')}}", "_self");}
		});
	});
</script>