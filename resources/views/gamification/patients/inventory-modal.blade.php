<div wire:ignore.self class="modal fade" id="modal-inventory" tabindex="-1" role="dialog" aria-labelledby="modal-inventory" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog {{ $size }} modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header p-2">
				<h6 class="modal-title font-weight-normal ps-3">{{ ucfirst($type) }}</h6>
				<button type="button" class="btn btn-sm btn-link text-white mb-0" data-bs-dismiss="modal" aria-label="Close">
					<span class="material-symbols-outlined">close</span>
				</button>
			</div>
			<div class="modal-body p-1 min-vh-35">
				<div class="py-3">
					<div class="text-center">
						@if($type == 'treatment')
						<img width="60" height="60" src="/assets/img/small-logos/icon-bulb.svg" class="d-block mx-auto" style="margin-bottom: 12px;"/>
						@else
						<img width="60" height="60" src="/assets/svg/{{$type}}/{{$title}}.svg" class="d-block mx-auto" style="margin-bottom: 12px;" />
						@endif

						<h4 class="mb-4">{{ $title }}</h4>
						@isset($extra) <p>{{ $extra }}</p>@endisset
					</div>

					@if($isAvail)
						@if($type == 'examination') {{-- examination only --}}
							@if(!$hasUsed) 
							<p class="text-center">
								<button @if($hasEnergy)wire:click.prevent="apply" @endif class="btn btn-sm btn-rounded {{ $hasEnergy ? 'bg-gradient-medsnapp' : 'btn-secondary' }} text-white font-weight-bolder w-50">
									@if($hasEnergy)
										@include('gamification.parts.'.$btn)
									@else
										@include('gamification.parts.no-energy-btn')
									@endif
								</button>
							</p>
							@endif
						@elseif($dependName)
						<p class="text-center">
							@include('gamification.parts.'.$btn)
						</p>
						@else
						<div class="text-center {{ $hasUsed ? 'd-none' : ''}}">
							<button @if($hasCoin)wire:click.prevent="apply({{$price}}, {{$expReward}}, {{$patientRecover}})" @endif class="btn btn-sm btn-rounded {{ $hasEnergy ? 'bg-gradient-medsnapp' : 'btn-secondary' }} text-white font-weight-bolder w-50">
								@if($hasUsed) <!-- alt. force to blank -->
									@include('gamification.parts.passed-btn')
								@elseif($hasAmount)
									@include('gamification.parts.'.$btn)
								@elseif($hasCoin)
									@include('gamification.parts.'.$btn)
								@else
									@include('gamification.parts.no-coin-btn')
								@endif
							</button>
						</div>
						@endif
					@endif <!-- end of isAvail check -->

					@if($hasEnergy && $type === 'examination')
						<div> <!-- only examination has body -->
							@if(null !== $bodySlot || $hasUsed) <!-- examination -->
							<div class="card card-body shadow-none mx-1 px-0">
								<ul class="text-md mb-0">
									@foreach($bodySlot as $contentItem)
										<li>{!! $contentItem !!}</li>
									@endforeach
								</ul>
							</div>
							@endif
						</div>
					@endif

					@isset($compSlot) <!-- investigation only -->
						@foreach($compSlot as $i => $com)
							@include('gamification.parts.inv-comps', ['com' => $com, 'val' => $valSlot[$i], 'sex' => $sex])
						@endforeach
					@endisset

					@if($valSlot && $type === 'treatment')
					<div class="text-center">
						@if(count($valSlot))
							<p class="font-weight-bolder text-success"><strong>Correct</strong></p>
						@else
							<p class="font-weight-bolder text-danger"><strong>Incorrect</strong></p>
						@endif
					</div>
					@endif

					<!-- another element show default if item already used before -->
					@isset($used)
						@foreach($used as $i => $com)
							@include('gamification.parts.inv-comps', ['com' => $com, 'val' => $valued[$i], 'sex' => $sex, 'hasDescription' => $hasDescription])
						@endforeach

						@if($valued && $type === 'treatment')
						<div class="text-center">
							@if(count($valued))
								<p class="font-weight-bolder text-success"><strong>Correct</strong></p>
							@else
								<p class="font-weight-bolder text-danger"><strong>Incorrect</strong></p>
							@endif
						</div>
						@endif
					@endisset

					<div class="text-center">
						<span wire:loading class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.addEventListener('inventoryModalEvent', event => {
		$('#modal-inventory').modal(event.detail.show ? 'show' : 'hide');
	})
</script>
