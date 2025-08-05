
	<div wire:ignore.self class="modal modal-medsnapp fade" id="modal-badges" tabindex="-1" role="dialog" aria-labelledby="modal-badges" aria-hidden="true" data-bs-keyboard="false">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
			<div class="modal-content">
				<button type="button" class="btn btn-sm btn-link text-white mb-0 position-absolute top-1 end-0 z-index-3" data-bs-dismiss="modal" aria-label="Close">
					<span class="material-symbols-outlined">close</span>
				</button>
				<div class="modal-body modal-body-medsnapp ps-lg-5 py-5">

					<div class="row">
						<div class="col-lg-2 col-12">
							<button wire:click="changeCat('mine')" wire:loading.attr="disabled" class="btn btn-outline-medsnapp text-white text-uppercase p-2 ps-lg-0 w-lg-100 w-sm-auto {{ $currCat == 'mine' ? 'disabled' : '' }}">My Badges</button>
							@foreach($cats as $cat)
							<button wire:click="changeCat('{{$cat}}')" wire:loading.attr="disabled" class="btn btn-outline-medsnapp text-white text-uppercase p-2 ps-lg-0 w-lg-100 w-sm-auto {{ $currCat == $cat ? 'disabled' : '' }}">{{$cat}}</button>
							@endforeach
							<button wire:click="changeCat('all')" wire:loading.attr="disabled" class="btn btn-outline-medsnapp text-white text-uppercase p-2 ps-lg-0 w-lg-100 w-sm-auto {{ $currCat == 'all' ? 'disabled' : '' }}">All</button>
						</div>
						<div class="col-lg-10 col-12 overflow-auto max-height-vh-60">
							<div wire:loading wire:target="changeCat" class="w-lg-80 w-100 btn btn-link btn-sm position-absolute text-white">
								<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...
							</div>
							<div wire:loading.remove class="row d-flex gx-0">
								@foreach($badges as $i => $item)

								@if($currCat == 'all' && ($i > 0 || $i < count($badges)) && ($badges[$i]->category !== $badges[($i-1 < 0 ? 0 : $i-1)]->category))
									</div>
									<div class="row d-flex gx-0">
								@endif

								<!-- {{count($badges).' '.$i}} -->
								<div class="col-2 text-center pb-2">
									@if(!$item->userBadgeExists)
									<div class="avatar avatar-lg" title="{{ ucfirst($item->category) }}">
										<img class="img-fluid opacity-1" src="/assets/badges/{{ str_replace(' ', '-', $item->badge_name) }}.png">
									</div>
									@elseif($item->hasClaimed)
									<div class="avatar avatar-lg" title="{{ ucfirst($item->category) }}">
										<img class="img-fluid opacity-100" src="/assets/badges/{{ str_replace(' ', '-', $item->badge_name) }}.png">
									</div>
									@else
									<div wire:click.prevent="claimValue('{{$item->skey}}')" class="avatar avatar-lg bg-gradient-medsnapp cursor-pointer">
										<img class="img-fluid opacity-{{ $item->userBadgeExists ? '100' : '1' }}" src="/assets/badges/{{ str_replace(' ', '-', $item->badge_name) }}.png" data-bs-toggle="tooltip" data-bs-placement="top" title="Claim Boost">
									</div>
									@endif
									<p class="m-0 text-sm">{{ $item->badge_name }}</p>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>