<div class="card card-body with-border pt-4 pb-3 h-100">
	<div class="row">
		<div class="col text-center">
			<div class="avatar avatar-md">
				<img width="50" height="50" src="/assets/svg/ui/specialty.svg" class="d-block mx-auto"/>
			</div>
			<p class="text-white text-sm opacity-100 mb-0 pt-1">Speciality</p>
			<p wire-disable:poll.visible.15s class="text-white text-xs mb-0">{{ $currentUser->speciality ?? 'Medicine' }}</p>
		</div>
		<div class="col text-center">
			<div class="avatar avatar-md">
				<img width="50" height="50" src="/assets/svg/ui/rank.svg" class="d-block mx-auto"/>
			</div>
			<p class="text-white text-sm mb-0 pt-1">Rank</p>
			<p wire:poll.visible.30s class="text-white text-xs mb-0">{{ $currentUser->rank ?? 'FY1' }}</p>
		</div>
		<div class="col text-center">
			<div class="avatar avatar-md">
				<img width="50" height="50" src="/assets/svg/ui/level.svg" class="d-block mx-auto"/>
			</div>
			<p class="text-white text-sm mb-0 pt-1">Level</p>
			<p wire:poll.visible.15s class="text-white text-xs mb-0">{{ $currentUser->level ?? 1}}</p>
		</div>
		<div class="col text-center">
			<div class="avatar avatar-md">
				<img width="50" height="50" src="/assets/svg/ui/reputation.svg" class="d-block mx-auto"/>
			</div>
			<p class="text-white text-sm mb-0 pt-1">Reputation</p>
			<p wire:poll.visible.5s class="text-white text-xs mb-0">{{ $currentUser->reputation ?? 0}}</p>
		</div>
	</div>
</div>
	