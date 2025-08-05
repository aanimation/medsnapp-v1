{{--
	NOTE: wire:visible help to reduce request only if this component visible
--}}
<!-- leaderboard -->
<div wire:visible class="card card-body with-border mb-2 h-100">
	<h5 class="font-weight-normal opacity-7 mx-auto mb-4">Leaderboard</h5>
	
	@if(count($top3) == 3)
	<div wire:poll.visible.15s class="row">
		<div class="col text-center">
			<div class="avatar avatar-lg position-relative mt-3">
				<img class="mb-1" alt="second" width="20" height="auto" src="/assets/svg/ui/second-place.svg"/>
			</div>
			<h6 class="m-0 text-sm text-capitalize">{{ Str::limit($top3[1]['username'], 10) ?? 'Player' }}</h6>
			<p class="m-0 text-xs">{{ $top3[1]['atts']['exps'] }} XP</p>
		</div>
		<div class="col text-center">
			<div class="avatar avatar-xl position-relative">
				<img class="mb-1" alt="first" width="20" height="auto" src="/assets/svg/ui/first-place.svg"/>
			</div>
			<h6 class="m-0 text-sm text-capitalize">{{ Str::limit($top3[0]['username'], 10) ?? 'Player' }}</h6>
			<p class="m-0 text-xs">{{ $top3[0]['atts']['exps'] }} XP</p>
		</div>
		<div class="col text-center">
			<div class="avatar avatar-lg position-relative mt-3">
				<img class="mb-1" alt="third" width="20" height="auto" src="/assets/svg/ui/third-place.svg"/>
			</div>
			<h6 class="m-0 text-sm text-capitalize">{{ Str::limit($top3[2]['username'], 10) ?? 'Player' }}</h6>
			<p class="m-0 text-xs">{{ $top3[2]['atts']['exps'] ?? 0 }} XP</p>
		</div>
	</div>
	@endif

	@if($items)
	<div class="row">
		<div class="col-12 mt-5"> 			
			<!-- Mobile -->
			<button wire:click="setStatus('{{ $status }}')" class="btn btn-sm btn-link w-100 text-white text-capitalize opacity-7 font-weight-normal d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLeaderboard" aria-expanded="false" aria-controls="collapseLeaderboard">{{ $status === 'down' ? 'Expand' : 'Hide'}}
				<i class="fa fa-chevron-{{ $status }} me-2"></i>
			</button>
			<div class="collapse {{ $status === 'up' ? 'show' : '' }}" id="collapseLeaderboard">
			@foreach($items as $item)
				<button wire:key="lead-{{ $loop->iteration }}" class="btn btn-lg btn-outline-{{ $loop->iteration <= 3 ? 'medsnapp p-2 text-white text-bolder opacity-7' : 'secondary p-1 ps-2 pe-2'}} w-100 d-flex mb-3" type="button">
					<div class="text-sm text-{{ auth()->id() === $item->id ? 'white' : 'normal'}} text-capitalize text-start {{ $loop->iteration <= 3 ? 'text-bold' : 'text-white-50'}} ps-2 w-70 my-auto">{{ $loop->iteration }}.  {{ $item->username }}</div>
					<p class="w-25 text-xs my-auto text-end">{{ $item->Atts->exps ?? 0 }} XP</p>
				</button>
			@endforeach
			</div>
			<!-- End Mobile -->

			<div wire:poll.visible.15s class="d-sm-none">
			@foreach($items as $item)
				<button wire:key="lead-{{ $loop->iteration }}" class="btn btn-lg btn-outline-{{ $loop->iteration <= 3 ? 'medsnapp p-2 text-white text-bolder opacity-7' : 'secondary p-1 ps-2 pe-2'}} w-100 d-flex mb-3" type="button">
					<div class="text-sm text-{{ auth()->id() === $item->id ? 'white' : 'normal'}} text-capitalize text-start {{ $loop->iteration <= 3 ? 'text-bold' : 'text-white-50'}} ps-2 w-70 my-auto">{{ $loop->iteration }}.  {{ $item->username }}</div>
					<p class="w-25 text-xs my-auto text-end">{{ $item->Atts->exps ?? 0 }} XP</p>
				</button>
			@endforeach
			</div>
		</div>
	</div>
	@endif
</div>
<!-- end leaderboard -->