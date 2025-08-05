<div wire:ignore.self class="modal fade" id="modal-purchase" tabindex="-1" role="dialog" aria-labelledby="modal-purchase" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
							<img width="60" height="60" src="/assets/svg/ui/{{$item->icon}}.svg" class="d-block mx-auto"/>
						</div>
						<hr>
						<h6 class="ps-3">{{ $item->name }}</h6>
						<div class="list-group">
							<div class="list-group-item d-flex">
								<span class="w-25">Type</span>: {{ ucfirst($item->type) }}
							</div>
							<div class="list-group-item d-flex">
								<span class="w-25">Category</span>: {{ $item->category }}
							</div>
							<div class="list-group-item d-flex">
								<span class="w-25">Price</span>: £{{ $item->price_dec ?? $item->price }}
							</div>
							
							@if($item->description)
							<div class="list-group-item d-flex">
								<span class="w-25">Description</span>: {{ $item->description ?? 'No description' }}
							</div>
							@endif
						</div>
						
						<button wire:click="purchaseItem('{{$item->skey}}')" class="btn btn-md bg-gradient-medsnapp text-white font-weight-bolder w-50 mx-auto mt-3 mb-0 shadow" wire:loading.attr="disabled">Purchase<span wire:loading wire:target="purchaseItem" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></button>
					</div>
				</div>
			</div>
			@endisset
		</div>
	</div>
</div>

<script type="text/javascript">
	window.addEventListener('purchaseEvent', event => {
		$('#modal-purchase').modal(event.detail.show ? 'show' : 'hide');
	})
</script>