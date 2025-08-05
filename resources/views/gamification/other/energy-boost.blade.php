<div class="row">
	@foreach($weekly as $idx => $item)
		<div class="col text-center p-0">
			@if($dayOfWeek === $idx)
			<button type="button" class="btn btn-link opacity-{{$isAvail ? 10 : 2}} btn-tooltip p-0{{ $isAvail ? '' : ' disabled' }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-container="body" data-animation="true" title="Claim" wire:click="claimDailyEnergy">
			@elseif($idx < $dayOfWeek && $idx > 0)
			<button type="button" class="btn btn-link opacity-2 p-0 disabled">
			@else
			<button type="button" class="btn btn-link opacity-5 p-0">
			@endif
				<img width="35" height="35" src="/assets/svg/ui/energy.svg" class="d-block mx-auto"/>
			</button>				
			<p class="m-0 text-sm">
				<span class="d-sm-none">{{ ucfirst($item) }}</span>
				<span class="d-xl-none d-lg-none d-md-none">{{ ucfirst(Str::limit($item, 3, '')) }}</span>
			</p>
		</div>
	@endforeach
</div>