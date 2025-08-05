<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2">
		
		<div class="row">
			<div class="col-12 col-lg-6 mb-4">
				@livewire('user.attributes')
			</div>
			<div class="col-12 col-lg-6 mb-4">
				@livewire('user.levels')
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-12">
				<div class="card h-100 min-vh-50">
					<div class="card-header p-3">
						<h5 class="mb-2">Summary</h5>
						<p class="mb-0">All the details about last patient.</p>
						<p class="mb-0 text-muted">{{ $userQuest->Quest->title }} | {{ $userQuest->Quest->name }} ({{ $userQuest->Quest->age }} years old)</p>
					</div>
					<div class="card-body p-3">
						<div class="row">
							<div class="col-lg-3 text-center">
								<div class="border border-medsnapp border-1 border-radius-md py-3">
									<h6 class="text-warning text-gradient font-weight-normal mb-0">Time</h6>
									<div class="font-weight-normal mb-0"><span class="small">{{ intdiv($userQuest->created_at->diffInSeconds($userQuest->finished_at), 60) }} minutes {{ $userQuest->created_at->diffInSeconds($userQuest->finished_at) % 60 }} seconds</span></div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 text-center">
								<div class="border border-medsnapp border-1 border-radius-md py-3">
									<h6 class="text-white font-weight-normal mb-0">Examinations</h6>
									<div class="font-weight-normal mb-0">{{ $userQuest->examination }}</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 text-center mt-4 mt-lg-0">
								<div class="border border-medsnapp border-1 border-radius-md py-3">
									<h6 class="text-white font-weight-normal mb-0">Investigations</h6>
									<div class="font-weight-normal mb-0">{{ $userQuest->investigation }}</div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 text-center mt-4 mt-lg-0">
								<div class="border border-medsnapp border-1 border-radius-md py-3">
									<h6 class="text-white font-weight-normal mb-0">Treatments</h6>
									<div class="font-weight-normal mb-0">{{ $userQuest->treatment }}</div>
								</div>
							</div>
							<div class="col-lg-3 col-12 text-center my-lg-4">
								<div class="border border-medsnapp border-1 border-radius-md py-3">
									<h6 class="text-success text-gradient font-weight-normal mb-0">Reputation</h6>
									<h5 class="font-weight-normal mb-0"><span class="small">{{$userQuest->reputation > 0 ? '+' : ''}}{{ $userQuest->reputation ?? 10 }}</span></h5>
								</div>
							</div>
							<div class="col-lg-3 col-12 text-center my-lg-4">
								<div class="border border-medsnapp border-1 border-radius-md py-3">
									<h6 class="text-info text-gradient font-weight-normal mb-0">XP gained</h6>
									<h5 class="font-weight-normal mb-0"><span class="small">{{ $userQuest->reputation > 0 ? '+25' : 0 }}</span></h5>
								</div>
							</div>
							<div class="col-lg-3 col-12 text-center my-lg-4">
								<div class="border border-medsnapp border-1 border-radius-md py-3">
									<h6 class="text-warning text-gradient font-weight-normal mb-0">Coins gained</h6>
									<h5 class="font-weight-normal mb-0"><span class="small">{{ $userQuest->reputation > 0 ? '+20' : 0 }}</span></h5>
								</div>
							</div>
							<div class="col-lg-3 col-12 text-center my-lg-4">
								<div class="border border-medsnapp border-1 border-radius-md py-3">
									<h6 class="text-success text-gradient font-weight-normal mb-0">Energy gained</h6>
									<h5 class="font-weight-normal mb-0"><span class="small">{{ $userQuest->reputation > 0 ? '+20' : 0 }}</span></h5>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer p-3 pb-4 text-center">
						<a href="{{ route('lobby') }}" class="btn btn-success btn-lg bg-gradient-medsnapp text-white font-weight-bolder shadow w-lg-20 w-md-60 w-sm-60 mx-lg-3">Patient Lobby</a>
						<a href="{{ route('shop') }}" class="btn btn-lg bg-gradient-dark text-white font-weight-bolder shadow w-lg-20 w-md-60 w-sm-60 mx-lg-3"><img width="20" height="auto" src="/assets/svg/ui/shop.svg" alt="shop"/> Shop</a>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- end container -->
</div>
