<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
	navbar-scroll="true">
	<div class="container-fluid py-1 px-3 px-sm-0">
		@if(Route::currentRouteName() == 'subscription')
		<a class="align-items-center pe-3" href="{{ route('player-dashboard') }}">
			<img width="175" height="auto" src="/assets/img/logos/medsnapp-svg.svg" class="h-100" alt="medsnapp-logo">
		</a>
		@else
		<nav class="d-sm-none" aria-label="breadcrumb">
			<h6 class="font-weight-bolder mt-3"><span class="me-2">👋</span>Welcome <span class="{{ auth()->user()->is_new ? 'd-none' : '' }}">back</span> <a href="{{ route('player-dashboard') }}">Dr. {{ auth()->user()->info ? auth()->user()->info->lastname : auth()->user()->username }}</a>
				<i class="fa fa-check-circle ms-2 text-info {{ auth()->user()->hasSubscribed ? '' : 'd-none' }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Premium" data-container="body" data-animation="true"></i>
			</h6>
		</nav>
		@endif
		<div class="collapse navbar-collapse mt-sm-0 mt-2 me-0" id="navbar">

			<div class="ms-md-auto pe-md-3 d-flex align-items-center">
				<!-- empty space -->
			</div>

			@livewire('other.top')
		</div>
	</div>
</nav>
