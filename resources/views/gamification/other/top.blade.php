<ul class="navbar-nav">
	<li class="nav-item d-xl-none pe-3 d-flex align-items-center">
		<a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
			<div class="sidenav-toggler-inner">
				<i class="sidenav-toggler-line"></i>
				<i class="sidenav-toggler-line"></i>
				<i class="sidenav-toggler-line"></i>
			</div>
		</a>
	</li>

	@if(auth()->user()->is_active)
		@livewire('other.bonuses')
		@livewire('other.notification')
	@endif
	

	<li class="nav-item dropdown pe-2 d-flex align-items-center">
		<a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButtonProfile"
			data-bs-toggle="dropdown" aria-expanded="false">
			<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 16 16" xml:space="preserve" class=""><g><path d="M256 292.1c33 0 63.5-9.3 87.9-25.1 18.9-12.1 43.5-10.1 60.1 5 46.1 41.8 72.3 101.1 72.2 163.4v26.7c0 27.6-22.4 49.9-50 49.9H85.8c-27.6 0-50-22.3-50-49.9v-26.7c-.2-62.2 26-121.6 72.1-163.3 16.6-15.1 41.3-17.1 60.1-5 24.5 15.7 54.9 25 88 25z" fill="#d5d5d5" opacity="1" data-original="#000000"></path><circle cx="256" cy="123.8" r="123.8" fill="#d5d5d5" opacity="1" data-original="#000000"></circle></g></svg>
		</a>
		<ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
			aria-labelledby="dropdownMenuButtonProfile">

			@if(auth()->user()->is_active)
			<li class="mb-2">
				<a class="dropdown-item border-radius-md" href="{{ route('player-profile') }}">
					<div class="d-flex py-1">
						<div class="d-flex flex-column justify-content-center">
							<h6 class="text-sm font-weight-normal mb-1">
								Profile Settings
							</h6>
						</div>
					</div>
				</a>
			</li>
			<li class="mb-2">
				<a class="dropdown-item border-radius-md" href="{{ route('invite') }}">
					<div class="d-flex py-1">
						<div class="d-flex flex-column justify-content-center">
							<h6 class="text-sm font-weight-normal mb-1">
								Invite Friend
							</h6>
						</div>
					</div>
				</a>
			</li>
			<li class="mb-2">
				<a class="dropdown-item border-radius-md" href="{{ route('help') }}">
					<div class="d-flex py-1">
						<div class="d-flex flex-column justify-content-center">
							<h6 class="text-sm font-weight-normal mb-1">
								Help
							</h6>
						</div>
					</div>
				</a>
			</li>

			<li class="mb-2 {{ Route::currentRouteName() == 'subscription' ? 'd-none' : '' }}">
				<a class="dropdown-item border-radius-md" href="{{ route('subscription') }}">
					<div class="d-flex py-1">
						<div class="d-flex flex-column justify-content-center">
							<h6 class="text-sm font-weight-normal mb-1">
								Subscriptions
							</h6>
						</div>
					</div>
				</a>
			</li>
			@endif

			<li class="mb-0">
				<a class="dropdown-item border-radius-md" href="{{ route('logout') }}">
					<div class="d-flex py-1">
						<div class="d-flex flex-column justify-content-center">
							<h6 class="text-sm font-weight-normal mb-1">
								Sign Out
							</h6>
						</div>
					</div>
				</a>
			</li>
		</ul>
	</li>
	
</ul>