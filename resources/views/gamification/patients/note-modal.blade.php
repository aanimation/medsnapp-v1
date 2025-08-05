<div wire:ignore.self class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-labelledby="modal-inventory" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog {{ $size }} modal-dialog-centered" role="document">
		<div class="modal-content" style="background-color: #334559;">
			<div class="modal-header p-2">
				<h6 class="modal-title font-weight-normal ps-3">{{ ucfirst($type) }}</h6>
				<button type="button" class="btn btn-sm btn-link text-white mb-0" data-bs-dismiss="modal" aria-label="Close">
					<span class="material-symbols-outlined">close</span>
				</button>
			</div>
			<div class="modal-body p-1">
				@if($current)
				<div class="py-3">
					<div class="text-center">
						@if($current->type === 'treatment')
						<img width="60" height="60" src="/assets/img/small-logos/icon-bulb.svg" class="d-block mx-auto" style="margin-bottom: 12px;"/>
						@else
						<img width="60" height="60" src="/assets/svg/{{$current->type}}/{{$current->name}}.svg" class="d-block mx-auto" style="margin-bottom: 12px;" />
						@endif

						<h4 class="mb-4">{{ $current->name }}</h4>
					</div>

					@isset($current->extra)
						<p>{{ $current->extra }}</p>
					@endisset

					@if($current->type === 'examination')
						<div class="text-start">
							<div class="card card-body shadow-none mx-1 px-0">
								<ul class="text-md mb-0">
									@foreach(json_decode($current->specifications) as $contentItem)
										<li>{!! $contentItem !!}</li>
									@endforeach
								</ul>
							</div>
						</div>
					@endif

					@foreach($current->Components as $i => $com)
						@include('gamification.parts.inv-comps', ['type' => $current->type, 'category' => $current->category, 'com' => $com, 'val' => $current->Value[$i], 'sex' => $sex, 'hasDescription' => true])
					@endforeach

					@if($current->type === 'treatment')
					<div class="text-center">
						<p class="font-weight-bolder"><span class="text-{{$current->value_count > 0 ? 'success' : 'danger'}}">{{$current->value_count > 0 ? 'Correct' : 'Incorrect'}}</span></p>
					</div>
					@endif
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.addEventListener('noteModalEvent', event => {
		$('#modal-note').modal(event.detail.show ? 'show' : 'hide');
	})
</script>
