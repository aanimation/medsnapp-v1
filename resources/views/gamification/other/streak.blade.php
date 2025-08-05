<div class="row justify-content-center">
	<div class="col-12">
		<div class="card card-body with-border p-0">
			<h6 class="m-3 ms-4 mb-0">Streak</h6>
			<div class="row justify-content-center">
				<div class="col-lg-8 col-12">
					<!-- main streak -->
					<div class="card shadow-none">
						<div class="card-body p-sm-1 pb-sm-0 pb-md-0 p-lg-3 pt-lg-4 pb-lg-0">
							<div class="text-center">
								<div class="img-fluid mb-3">
									<img width="155" height="auto" src="/assets/img/shapes/fire{{count($data) == 7 ? '-blue' : ''}}.png" class="h-100" alt="flame-lg">
									<div class="text-white fs-10 text-shadow fw-bolder position-absolute top-40 start-50 translate-middle" style="font-weight: 800!important;">{{ $streakCount }}</div>
								</div>
								<h2>day streak!</h2>
							</div>
							<div class="streak-group border-secondary text-center py-sm-3 px-sm-1 p-lg-3">
								@if(count($data) > 0)
									@foreach($data as $day => $value)
										<div class="{{ $loop->last ? '' : 'streak-item' }} btn-group-vertical mx-sm-auto mx-md-3 mx-lg-4">
											<div class="mb-2 text-bolder{{ $today == $day ? ' text-warning' : '' }}">{{ Str::limit($day, 2, '') }}</div>
											<button class="btn btn-md btn-{{ count($data) == 7 && $loop->last ? 'info' : 'white'}} btn-icon-only rounded-circle mb-1 p-1">
												<span class="btn-inner--icon"><i class="fa fa-{{ count($data) == 7 && $loop->last ? 'star' : 'check'}} text-md mt-1"></i></span>
											</button>
										</div>
									@endforeach
								@endif

								@foreach($days as $day => $value)
									@if(($today == $day && $todayStreak) || ($yesterday == $day && $yesterdayStreak))
										<div class="btn-group-vertical mx-sm-auto mx-md-3 mx-lg-4">
											<div class="mb-2 text-bolder{{ $today == $day ? ' text-warning' : '' }}">{{ Str::limit($day, 2, '') }}</div>
											<button class="btn btn-md btn-white btn-icon-only rounded-circle mb-1 p-1">
												<span class="btn-inner--icon"><i class="fa fa-check text-md text-white mt-1"></i></span>
											</button>
										</div>
									@else
									<div wire:key="day-{{$loop->iteration}}" class="btn-group-vertical mx-sm-auto mx-md-3 mx-lg-4">
										<div class="mb-2 text-bolder{{ $today == $day ? ' text-warning' : '' }}">{{ Str::limit($day, 2, '') }}</div>
										<button @if($today == $day)wire:click="goStreak"@endif class="btn btn-md btn-{{ $loop->last ? 'warning' : 'secondary' }} btn-icon-only rounded-circle mb-1 p-1">
											@if($loop->last)
												<span class="btn-inner--icon"><i class="fa fa-star text-white text-md mt-1"></i></span>
											@endif
										</button>
									</div>
									@endif
								@endforeach
							</div>
						</div>
						<div class="card-footer border-dark p-sm-1 pt-sm-0 pt-md-0 p-lg-3 pt-lg-0 mb-4">
							<div class="text-center text-md pt-3 pb-2" >
								<h5>{{ $greetings[count($data)] }}! Keep your <span class="text-warning">perfect streak</span> going tomorrow</h5>
							</div>
						</div>
					</div>
					<!-- end main streak -->
				</div>
			</div>
		</div>
	</div>
</div>