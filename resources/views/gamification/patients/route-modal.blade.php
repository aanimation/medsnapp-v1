<div wire:ignore.self class="modal fade" id="modal-route" tabindex="-1" role="dialog" aria-labelledby="modal-route" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog {{ $size }} modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header p-2">
				<h6 class="modal-title font-weight-normal ps-3">{{ ucfirst($type) }}</h6>
				<button type="button" class="btn btn-sm btn-link text-white mb-0" data-bs-dismiss="modal" aria-label="Close">
					<span class="material-symbols-outlined">close</span>
				</button>
			</div>
			<div class="modal-body p-1">
				<div class="py-3">
					<div class="text-center">
						<h4 class="mb-4">{{ $title }}</h4>
						<p>Please select which route</p>
						@foreach($siblings as $idx => $sb)
							<button wire:key="route-{{$idx}}" wire:click="continue('{{$sb->skey}}')" class="btn btn-sm bg-gradient-medsnapp text-white font-weight-bolder px-4">{!! $sb->specifications !!}</button>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.addEventListener('routeModalEvent', event => {
		$('#modal-route').modal(event.detail.show ? 'show' : 'hide');
	})
</script>
