<div class="container-fluid py-2 px-sm-2 px-xl-4 px-xxl-12">
	<div class="row">
		<div class="col-lg-12 mt-lg-0 mt-4">
			<div class="card card-body with-border mb-4" id="profile">
				<div class="row justify-content-between">
					
				</div>
				<div class="row">
					<div class="col-lg-6 col-sm-auto ps-3">
						<div class="h-100">
							<h5 class="mb-1 font-weight-bolder">
								{{ strtoupper($username) }}
							</h5>
							<p class="mb-0 font-weight-normal text-sm">
								{{ $item->speciality }} - {{ 'level ' . $item->level }}
							</p>
						</div>
					</div>

					@if($item->is_active)
					<div class="col-lg-6 col-sm-auto">
						<div class="d-block ms-lg-3 float-end">
							@include('gamification.user.profile-tab')
						</div>
					</div>
					@endif

				</div>
			</div>

			<div class="row">
				<!-- User Settings -->
				<div class="col-12 col-lg-6 mt-lg-0 order-sm-2">
					<div class="card card-body with-border p-3 h-100 min-vh-25 mt-sm-4">
						<h5 class="font-weight-normal">Billing</h5>
						<h6 class="text-capitalize text-body text-xs font-weight-normal opacity-7 my-3">Transaction History
						</h6>
						<div class="text-center text-sm text-muted {{ count($history) ? 'd-none' : ''}}">No transactions yet</div>
						<ul class="list-group overflow-auto" style="max-height: 28em;">
							@foreach($history as $item)
							<li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
								<div class="d-flex align-items-center">
									<div class="ms-0 p-2 pe-4 btn-sm d-flex align-items-start justify-content-start">
										<i class="material-icons text-muted">circle</i>
									</div>
									<div class="d-flex flex-column">
										<h6 class="mb-1 text-dark text-sm">{{ $item->subject == 'subscription' ? '' : $item->quantity }} {{ ucfirst($item->subject) }}
										</h6>
										<span class="text-xs">{{ date('d M Y, H:i a', strtotime($item->trans_datetime)) }}
										</span>
									</div>
								</div>
								<div class="d-flex flex-column">
									<div class="mb-1 text-sm font-weight-normal text-uppercase">{{ $item->status }}</div>
									@if($item->discount)
									<span class="text-xs">
										Promo Applied
									</span>
									@endif
								</div>
								<div class="d-flex flex-column">
									<h6 class="mb-1 text-dark text-sm text-{{ $item->status === 'paid' ? 'success' : (is_null($item->cancelled_at) ? 'danger' : 'warning') }}">£{{$item->total_price}}</h6>
									@if($item->discount)
									<span class="text-xs">
										&minus;£{{ $item->discount }}
									</span>
									@endif
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
				<!-- end User Settings -->

				<!-- Game Settings -->
				<div class="col-12 col-lg-6 mt-lg-0 order-sm-1">
					<div class="card card-body with-border p-3 pb-4 h-100 min-vh-25">
						<h5 class="font-weight-normal">Current Plan</h5>
						<div class="w-100">
							<div class="d-flex mb-2">
								<span class="me-2 text-sm text-capitalize">Premium{{-- $currentTier --}}
								</span>
								<span class="ms-auto text-sm">{{ $freeDay }} days left
								</span>
							</div>
							<div>
								<div class="progress progress-md">
									<div class="progress-bar bg-gradient-dark" role="progressbar" style="width: <?= floor(($freeDay/$maxDays) * 100) ?>%;">
									</div>
								</div>
							</div>
						</div>

						@if(auth()->user()->username == 'demo-user' || !auth()->user()->hasSubscribed)
							<a href="{{ route('subscription') }}" class="btn btn-sm bg-gradient-medsnapp position-absolute bottom-4 end-3 text-white {{ $freeDay <= 14 ? '' : 'd-none'}}">{{ auth()->user()->hasExpired ? 'Extend' : 'Upgrade' }} Plan</a>
						@endif

						@if(auth()->user()->username == 'demo-user' && count($history))
							<div wire:click.prevent="resetDemo" wire:confirm.prompt="Are you sure you want to permanently reset this data?\nThis action cannot be reversed.\n\nType RESET to confirm|RESET" class="btn btn-sm bg-gradient-danger position-absolute start-3 bottom-4 me-lg-2 mt-4">Reset (Demo Only)</div>
						@endif
					</div>
				</div>
				<!-- end Game Settings -->
			</div>
			</form>
		</div>
	</div>
</div>
