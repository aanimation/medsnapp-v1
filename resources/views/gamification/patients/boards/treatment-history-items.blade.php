<!-- DEPRECATED -->

<div class="{{ $used->count() ? '' : ' d-none' }}">
	<hr>
	<h6 class="font-weight-normal">Used items</h6>
	<div class="row justify-content-center overflow-auto gx-0 max-height-vh-50">
		@foreach($used as $item)
			<div wire:loading.remove wire:target="search" class="col-auto">
				<div wire:key="card-treatment-{{$loop->index}}" title="{{ $item->name }} {{ $item->specifications }}" class="icon icon-inv icon-shape bg-gradient-dark selected shadow text-center text-white border-radius-xl position-relative m-1 py-4 cursor-pointer" wire:click="openInventoryModal('{{ $item->skey }}', 'treatment', 'male', false, true)">
					@if($item->usage->first()->is_correct)
					<i class="fas fa-star opacity-4 position-absolute" style="top: 5px; right: 5px;"></i>
					@endif
					{{ $item->name }}
					<div>{{ $item->specifications }}</div>
				</div>
			</div>
		@endforeach
	</div>
</div>