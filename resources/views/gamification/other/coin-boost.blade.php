<div class="row">
	@foreach($weekly as $idx => $item)
		<div class="col text-center p-0">
			@if($dayOfWeek === $idx)
			<button type="button" class="btn btn-link opacity-{{$isAvail ? 10 : 2}} btn-tooltip p-0{{ $isAvail ? '' : ' disabled' }}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-container="body" data-animation="true" title="Claim" wire:click="claimDailyCoin">
			@elseif($idx < $dayOfWeek && $idx > 0)
			<button type="button" class="btn btn-link opacity-2 p-0 disabled">
			@else
			<button type="button" class="btn btn-link opacity-5 p-0">
			@endif
				<img class="mb-1" alt="coins" width="39" height="39" src="/assets/svg/ui/coin.svg"/>
			</button>				
			<p class="m-0 text-sm">
				<span class="d-sm-none">{{ ucfirst($item) }}</span>
				<span class="d-xl-none d-lg-none d-md-none">{{ ucfirst(Str::limit($item, 3, '')) }}</span>
			</p>
		</div>
	@endforeach
</div>