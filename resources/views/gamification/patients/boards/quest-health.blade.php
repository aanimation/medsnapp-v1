<div id="atts">
	<h5 class="font-weight-normal w-100 mt-1">Health</h5>
	<div class="row">
		<div class="col ps-1 pb-4">
			<div class="d-flex">
				<div class="pt-3 ps-2 pe-2">
					<img width="25" height="auto" src="/assets/svg/ui/love.svg" class="d-block mx-auto"/>
				</div>
				<div class="w-100 progress-wrapper">
					<div class="progress-warning">
						<div class="progress-percentage">
							<span class="text-sm">&nbsp;</span>
							<span class="text-xs float-end mt-2">{{ $healthPatient ?? $atts['curr_health'] }}/100 HP</span>
							{{--
							NOTE: healthPatient from $userQuest->amount in QuestBoard
							--}}
						</div>
					</div>
					<div class="progress">
						<div wire:poll.visible.5s class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="{{ $atts['curr_health'] }}" aria-valuemin="0" aria-valuemax="100" style="width: <?= $healthPatient ?? $atts['curr_health'] ?>%;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@if(($healthPatient ?? $atts['curr_health']) <= 1)
	<div class="row">
		<div class="col">
			<div class="d-block mt-3">
				<div class="text-center px-3">
					<button wire:click="recoveryMode('giveup')" class="btn btn-sm bg-gradient-dark text-white me-5 w-40">Retry</button>
					<button wire:click="recoveryMode('revive')" class="btn btn-sm bg-gradient-danger text-white w-40">Revive</button>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>