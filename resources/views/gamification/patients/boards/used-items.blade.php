<div class="card card-body with-border h-100">
	<div class="px-sm-1 max-height-300 overflow-y-auto">
		<div class="row px-sm-3">
			<h5 class="font-weight-normal mt-1 mb-4">Used Items</h5>

			<div class="col-12">
				<h6 class="font-weight-normal px-sm-3">Examination</h6>
				<hr>
				<div class="row justify-content-center">
					@foreach($exa as $idx => $item)
						<div class="col-auto">
							<div wire:key="used-exa-{{ $idx }}-used" title="{{ $item->Inventory->name }}" class="icon icon-inv icon-shape bg-gradient-dark shadow text-center border-radius-xl position-relative cursor-pointer m-1" wire:click="openNoteModal('{{ $item->Inventory->skey }}')">
							  <img width="50" height="50" src="/assets/svg/{{$item->Inventory->type}}/{{$item->Inventory->name}}.svg" class="d-block mx-auto" style="margin-top: 20px;"/>
							  <div class="mx-auto text-center text-white text-xs pt-1">{{ $item->Inventory->name }}</div>
							</div>
						</div>
					@endforeach
				</div>
				
				<h6 class="font-weight-normal px-sm-3 mt-4">Investigation</h6>
				<hr>
				<div class="row justify-content-center">
					@foreach($inv as $idx => $item)
						<div class="col-auto">
							<div wire:key="used-inv-{{ $idx }}" title="{{ $item->Inventory->name }}" class="icon icon-inv icon-shape bg-gradient-dark selected shadow text-center border-radius-xl position-relative m-1 cursor-pointer" wire:click="openNoteModal('{{ $item->Inventory->skey }}')">
								<img width="50" height="50" src="/assets/svg/{{$item->Inventory->type}}/{{$item->Inventory->name}}.svg" class="d-block mx-auto" style="margin-top: 20px;"/>
								<div class="mx-auto text-center text-white text-xs pt-1">{{ $item->Inventory->name }}</div>
								@if($item->Inventory->user_inv_amount > 0)
								<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x{{$item->Inventory->user_inv_amount}}</span>
								@endif
							</div>
						</div>
					@endforeach
				</div>
				
				<h6 class="font-weight-normal mt-4">Treatment</h6>
				<hr>
				<div class="row justify-content-center">
					@foreach($tre as $item)
						<div class="col-auto">
							<div wire:key="used-trea-{{$loop->index}}" title="{{ $item->Inventory->name }} {{ $item->Inventory->specifications }}" class="icon icon-inv icon-shape bg-gradient-dark selected shadow text-xs text-center text-white border-radius-xl position-relative m-1 py-5 px-0 cursor-pointer" wire:click="openNoteModal('{{ $item->Inventory->skey }}')">
								@if($item->Inventory->usage->first()->is_correct)
								<i class="fas fa-star opacity-4 position-absolute" style="top: 5px; right: 5px;"></i>
								@endif
								{{ $item->Inventory->name }}
								<div>{{ $item->specifications }}</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>

		</div>
	</div>
</div>