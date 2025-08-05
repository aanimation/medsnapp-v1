<div wire:ignore.self class="modal fade" id="modal-shop" tabindex="-1" role="dialog" aria-labelledby="modal-shop" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header p-2">
				<h6 class="modal-title font-weight-normal ps-3">Item</h6>
				<button type="button" class="btn btn-sm btn-link text-white mb-0" data-bs-dismiss="modal" aria-label="Close">
					<span class="material-symbols-outlined">close</span>
				</button>
			</div>
			@isset($item)
			<div class="modal-body p-1">
				<div class="py-3">
					<div class="text-center">
						<div>
							@if($item->type === 'recovery')
							<img width="80" height="auto" src="/assets/svg/revive/{{$item->icon}}.png" class="d-block mx-auto"/>
							@elseif($item->type === 'treatment')
							<img width="80" height="0" src="/assets/img/small-logos/icon-bulb.svg" class="d-block mx-auto"/>
							@else
							<img width="80" height="80" src="/assets/svg/{{$item->type}}/{{$item->name}}.svg" class="d-block mx-auto"/>
							@endif
						</div>
						<hr>
						<h6 class="ps-3">{{ $item->name }}
							{{ $item->type == 'treatment' && $item->specifications ? ' | '.$item->specifications : '' }}
						</h6>
						<div class="list-group">
							<div class="list-group-item d-flex font-weight-bolder">
								<span class="w-25">Available</span>: {{ $item->user_inv_amount <= 0 ? 0 : $item->user_inv_amount }} pc{{$item->user_inv_amount > 1 ? 's':''}}
							</div>
							<div class="list-group-item d-flex">
								<span class="w-25">Type</span>: {{ ucfirst($item->type) }}
							</div>
							<div class="list-group-item d-flex">
								<span class="w-25">Category</span>: {{ $item->category }}
							</div>
							<div class="list-group-item d-flex">
								<span class="w-25">Price</span>: {{ $item->price }} <img class="ms-1" alt="coins" width="20" height="auto" src="/assets/svg/ui/coin.svg"/>
							</div>
							
							@if($item->description)
							<div class="list-group-item d-flex">
								<span class="w-25">Description</span>: {{ $item->description ?? 'No description' }}
							</div>
							@endif
						</div>
						@if($item->price)
							<button wire:click="buyItem('{{$item->skey}}')" class="btn btn-md bg-gradient-medsnapp text-white font-weight-bolder w-50 mx-auto mt-3 mb-0 shadow">Buy<span wire:loading wire:target="buyItem" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
						@endif
						<p class="mx-auto my-0">{{ $message }}</p>
					</div>
				</div>
			</div>
			@endisset
		</div>
	</div>
</div>

<script type="text/javascript">
	window.addEventListener('shopModalEvent', event => {
		$('#modal-shop').modal(event.detail.show ? 'show' : 'hide');
	})
</script>
