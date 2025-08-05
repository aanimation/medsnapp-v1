<div wire:ignore.self class="modal fade" id="modal-revive" tabindex="-1" role="dialog" aria-labelledby="modal-revive" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog {{ $size }} modal-dialog-centered" role="document">
		<div class="modal-content" style="background-color: #1e263c;">
			<div class="modal-header p-2">
				<h6 class="modal-title font-weight-normal ps-3">Recovery Patient Health</h6>
				<button type="button" class="btn btn-sm btn-link text-white mb-0" data-bs-dismiss="modal" aria-label="Close">
					<span class="material-symbols-outlined">close</span>
				</button>
			</div>
			<div class="modal-body p-1">
				<div class="py-3">
					<div class="text-center">
						<h4 class="mb-4">Revive</h4>
						<div class="row justify-content-center overflow-auto gx-2">
							@foreach($revives as $idx => $rv)
								<div class="col-auto">
									<div wire:key="revive-{{ $idx }}" title="{{ $rv->name }}" class="icon icon-inv-revive icon-shape bg-dark text-center border-radius-xl position-relative m-1 cursor-pointer" wire:click="revive('{{ $rv->skey }}')">
										<img width="35" height="auto" src="/assets/svg/revive/{{$rv->icon}}.png" class="d-block mx-auto" style="margin-top: 10px;"/>
										@if($rv->user_inv_amount > 0)
										<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x{{$rv->user_inv_amount}}</span>
										@else
										<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">{{$rv->price2}} <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 18 18" xml:space="preserve" class=""><g><path fill="#ffbe39" d="M493.176 274.813c0 130.983-106.168 237.184-237.201 237.184-131 0-237.15-106.2-237.15-237.184 0-130.975 106.15-237.184 237.15-237.184 131.033 0 237.201 106.209 237.201 237.184z" opacity="1" data-original="#fbb040" class=""></path><path fill="#e38c00" d="M270.676 435.463c-131.001 0-196.551-72.533-233.001-111.434v43.566c10.767 25.301 25.8 48.334 44.2 68.234v-43.9c15.716 17 33.833 31.699 53.9 43.533v43.783a237.552 237.552 0 0 0 44.2 20.25v-43.733c17.184 5.8 35.2 9.8 53.9 11.533v43.634c7.3.666 14.65 1.066 22.1 1.066 7.467 0 14.85-.4 22.135-1.066v-43.634c18.699-1.733 36.715-5.733 53.898-11.533v43.7a235.757 235.757 0 0 0 44.201-20.217v-43.783c20.066-11.834 38.184-26.533 53.9-43.533v43.9c18.398-19.9 33.449-42.934 44.215-68.234v-43.566c-25.533 17.834-72.615 111.434-203.648 111.434zm-157.651-99.834c-9.684-21.633-15.2-45.566-15.2-70.808 0-95.9 77.717-173.65 173.634-173.65 59.332 0 111.666 29.8 142.982 75.191-12.933-70.108-97.298-117.041-167.966-117.041-95.9 0-177.767 86.866-177.767 182.758 0 36.567 2.834 83.2 44.317 103.55z" opacity="1" data-original="#f7941e" class=""></path><path fill="#fce800" d="M255.975.004c-131 0-237.15 106.2-237.15 237.175 0 131.018 106.15 237.185 237.15 237.185 131.033 0 237.201-106.167 237.201-237.185C493.176 106.204 387.008.004 255.975.004zm0 410.826c-95.9 0-173.633-77.75-173.633-173.651 0-95.892 77.733-173.649 173.633-173.649 95.918 0 173.668 77.758 173.668 173.649 0 95.901-77.75 173.651-173.668 173.651z" opacity="1" data-original="#f9ed32" class=""></path></g></svg></span>
										@endif
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.addEventListener('reviveModalEvent', event => {
		$('#modal-revive').modal(event.detail.show ? 'show' : 'hide');
	})
</script>
