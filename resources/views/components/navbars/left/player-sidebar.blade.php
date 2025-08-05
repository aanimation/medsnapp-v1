<aside id="sidenav-main" class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark">
	<div class="sidenav-header text-center">
		<i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
			aria-hidden="true" id="iconSidenav"></i>
			<a class="align-items-center pe-3" href="{{ route('player-dashboard') }}">
				<img width="175" height="auto" src="/assets/img/logos/medsnapp-svg.svg" class="h-100" alt="medsnapp_logo">
			</a>
	</div>
	<hr class="horizontal light mt-0 mb-2">
	<div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
		<ul class="navbar-nav">
			@if(!auth()->user()->hasActiveQuest || auth()->user()->username == 'demo-user')
			<li class="nav-item mt-3">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'shop' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('shop') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<img width="25" height="auto" src="/assets/svg/ui/shop.svg" alt="shop"/>
					</div>
					<span class="nav-link-text ms-1">Shop</span>
				</a>
			</li>
			@else
			<li class="nav-item mt-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Finish managing your patient to access.">
				<a class="nav-link text-white" href="#">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<img width="25" height="auto" src="/assets/svg/ui/shop.svg" alt="shop"/>
					</div>
					<span class="nav-link-text ms-1 text-muted">Shop</span>
				</a>
			</li>
			@endif

			<li class="nav-item mt-3">
				<a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['lobby', 'questboard']) ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('lobby') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<img width="25" height="auto" src="/assets/svg/ui/patient.svg" alt="patient"/>
					</div>
					<span class="nav-link-text ms-1">Patient</span>
					<span class="text-xs ms-2 mb-2" style="background-image: linear-gradient(to right, #d2bbf5 0%, #8f4ce8 30%, #642cae 100%); padding: 2px 7px; border-radius: 5px;">Beta</span>
				</a>
			</li>

			<li class="nav-item mt-3">
				<a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['questions', 'question-user']) ? ' active bg-gradient-medsnapp' : '' }}" href="{{ route('questions') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<img width="25" height="auto" src="/assets/svg/ui/questions.svg" alt="questions"/>
					</div>
					<span class="nav-link-text ms-1">Questions</span>
				</a>
			</li>

			<li class="nav-item mt-3">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'player-dashboard' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('player-dashboard') }}">
					<div class="text-white text-center ms-1 me-2 d-flex align-items-center justify-content-center">
						<img width="30" height="auto" src="/assets/svg/ui/game-stats.svg" alt="game-stats"/>
					</div>
					<span class="nav-link-text ms-1">Game Stats</span>
				</a>
			</li>

			<li class="nav-item mt-3">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'player-learnboard' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('player-learnboard') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<img width="25" height="auto" src="/assets/svg/ui/learning-stats.svg" alt="learning-stats"/>
					</div>
					<span class="nav-link-text ms-1">Learning Stats</span>
				</a>
			</li>
			
		</ul>
	</div>
	<div class="card shadow-none bg-transparent text-center position-absolute bottom-0 w-100 {{ Route::currentRouteName() == 'invite' ? 'd-none' : '' }}">
		<div class="card-body">
			<a href="{{ route('invite') }}" class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
				<i class="material-icons opacity-10" aria-hidden="true">group_add</i>
			</a>
			<h5 class="font-weight-bolder my-2">Invite Friends</h5>
			<p class="text-sm font-weight-normal mb-2">Invite friends and earn coins</p>
		</div>
	</div>
</aside>
