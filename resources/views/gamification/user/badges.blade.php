<div>
	<div class="card card-body with-border mb-4 p-2 pb-lg-4 pb-xl-4">
		<div class="d-flex mt-1">
			<h5 class="w-70 opacity-7 font-weight-normal ms-2 mt-1 mb-4">Badges
			</h5>
			<div title="show all badges" class="w-30 text-xs text-end text-muted cursor-pointer pe-2" data-bs-toggle="modal" data-bs-target="#modal-badges">Show All</div>
			@livewire('user.badges-modal')
		</div>
		<div class="row">
			@foreach($badges as $item)
				<div class="col text-center p-0">
					<div class="avatar avatar-lg">
						<img class="img-fluid opacity-{{ $item->userBadgeExists ? 100 : 1 }}" src="/assets/badges/{{ Str::replace(' ', '-', $item->badge_name) }}.png">
					</div>
					<p class="m-0 text-sm d-sm-none">{{ $item->badge_name }}</p>
				</div>
			@endforeach
		</div>
	</div>

	<div class="card card-body with-border mb-4 p-2 pb-lg-4 pb-xl-4">
		<h5 class="w-70 opacity-7 font-weight-normal ms-2 mt-2 mb-4">Boost</h5>
		@if($claimable->count())
		<div class="row px-3" wire:poll.visible.5s>
			@foreach($claimable as $item)
				<div wire:key="badge-boost-{{$loop->iteration}}" class="col-auto text-center mx-3 me-4 p-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Claim">
					<div wire:click="claimValue({{$item->id}})" class="avatar avatar-lg bg-gradient-medsnapp cursor-pointer">
						<img class="img-fluid opacity-100" src="/assets/badges/{{ Str::replace(' ', '-', $item->Badge->badge_name) }}.png">
					</div>
					<p class="m-0 text-sm d-sm-none">{{ $item->Badge->badge_name }}</p>
				</div>
			@endforeach
		</div>
		@else <!-- dummy to prevent height -->
		<div class="row px-3">
			<div class="col-auto text-center mx-3 p-0 opacity-0">
				<div class="avatar avatar-lg" titl>
					<img class="img-fluid" src="/assets/badges/level-1.png">
				</div>
				<p class="m-0 text-sm d-sm-none">dummy</p>
			</div>
		</div>
		@endif
	</div>

</div>