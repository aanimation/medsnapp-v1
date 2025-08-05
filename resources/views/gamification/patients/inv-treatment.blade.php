<div class="col-12">
	<div class="text-center">
		<div class="badge" style="text-transform: none;">Select up to {{ $maxAttempt }} treatments</div>
	</div>
	<div class="d-block text-center">
		@if(!$isSearch)
			<button wire:click="changeCategory('{{$pharm}}')" type="button" class="btn btn-sm bg-gradient-medsnapp text-white me-2 w-lg-25 w-xxl-15 {{ $currCat == $pharm ? 'disabled' : '' }}">{{ $pharm }}</button>
			<button wire:click="changeCategory('{{$nonPharm}}')" type="button" class="btn btn-sm bg-gradient-medsnapp text-white px-1 me-2 w-lg-25 w-xxl-15 {{ $currCat == $nonPharm ? 'disabled' : '' }}">{{ $nonPharm }}</button>
			<button wire:click="toggleCat" class="btn btn-sm bg-gradient-medsnapp" type="button">
				<i class="material-icons" style="font-size:1.1rem; color:white;">{{ !$isCat ? 'playlist_add_check' : 'playlist_remove' }}</i>
			</button>
		@endif
		<button wire:click="toggleSearch" class="btn btn-sm bg-gradient-medsnapp ms-2" type="button">
			<i class="material-icons" style="font-size:1.1rem; color:white;">search{{ !$isSearch ? '' : '_off' }}</i>
		</button>
		@if($isSearch)
		<div class="input-group input-group-static w-50 mx-auto mb-3">
			<input wire:model.live="search" type="search" class="form-control" placeholder="search">
		</div>
		@endif
	</div>
	<div class="row justify-content-center max-height-250 overflow-y-auto gx-2  mx-xxl-8">
		<div class="accordion-1">
			<div class="container">
				<div class="row justify-content-center overflow-y-auto overflow-x-hidden gx-0" style="max-height: 37em;">
					@if(($isSearch || $currCat1 == 'all') && !$isCat)
						@foreach($invs->where('is_sibling', 0)->where('usage_count', 0) as $item)
							<div wire:loading.remove wire:target="search" class="col-auto">
								<div wire:key="card-treatment-{{$loop->index}}" title="{{ $item->name }}" class="icon icon-inv icon-shape bg-dark{{$item->history_count>0 ? '-used' : ''}} shadow text-center text-white border-radius-xl position-relative m-1 py-4 cursor-pointer" wire:click="openInventoryModal('{{ $item->skey }}', 'treatment', 'male', {{$item->has_sibling ? 'true':'false'}})">
									<span class="text-xs">{{ $item->name }}</span>
									<div class="position-absolute translate-middle start-50 bottom-0 opacity-1{{ $item->has_sibling ? '' : ' d-none' }}">
										<i class="material-icons" style="font-size: 2em;">layers</i>
									</div>
									@if($item->user_inv_amount>0)
									<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x{{$item->user_inv_amount}}</span>
									@endif
								</div>
							</div>
						@endforeach
						
						<div wire:loading wire:target="loadMore, search" class="col-12 text-center">
							<div class="spinner-grow text-dark" role="status">
								<span class="sr-only">Loading...</span>
							</div>
						</div>

						@if($invs->count() < $invs->total())
							<button wire:click="loadMore('investigation')" wire:loading.attr="disabled" class="btn btn-link text-white mt-md-4"><span wire:loading.remove wire:target="loadMore, search">load&nbsp;more</span></button>
						@endif

					@endif

					<!-- accordion -->
					@if(!$isSearch && $isCat)
					<div class="col-12 mt-2">
						<div class="accordion" id="accordTreatment">
							@foreach($sub1 as $item)
							<div class="accordion-item">
								<div class="accordion-header text-xs" id="heading-{{$loop->index}}">
									<button wire:click="changeCatSub1('{{$item}}')" wire:loading.attr="disabled" class="accordion-button border-bottom pb-0 opacity-7 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$loop->index}}" aria-expanded="false" aria-controls="collapse-{{$loop->index}}">
										<span>{{ $item }}</span>
										<i class="collapse-close fa fa-{{$item == $currCat1 ? 'minus' : 'plus'}} text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
									</button>
								</div>
								<div wire:key="accord-{{$loop->index}}" wire:ignore.self id="collapse-{{$loop->index}}" class="accordion-collapse collapse max-height-vh-50" aria-labelledby="heading-{{$loop->index}}" data-bs-parent="#accordTreatment">
									<div class="accordion-body">

										<div class="row justify-content-start gx-2">
											<div wire:loading.remove class="dropdown">
												<div class="btn btn-sm bg-gradient-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownSub2">
													{{$currCat2}}
												</div>
												<ul class="dropdown-menu" aria-labelledby="navbarDropdownSub2">
													@foreach($sub2 as $itemSub)
													<li>
														<div wire:click="changeCatSub2('{{$itemSub}}')" class="dropdown-item">{{$itemSub}}</div>
													</li>
													@endforeach
												</ul>
											</div>

											@foreach($invs as $item)
												<div wire:loading.remove wire:target="changeCatSub2" class="col-auto">
													<div wire:key="card-treatment-{{$loop->index}}" title="{{ $item->name }}" class="icon icon-inv icon-shape bg-dark{{$item->history_count>0 ? '-used' : ''}} shadow text-center text-white border-radius-xl position-relative m-1 py-4 cursor-pointer" wire:click="openInventoryModal('{{ $item->skey }}', 'treatment', 'male', {{$item->has_sibling ? 'true':'false'}})">
														<span class="text-xs">{{ $item->name }}</span>
														<div class="position-absolute translate-middle start-50 bottom-0 opacity-1{{ $item->has_sibling ? '' : ' d-none' }}">
															<i class="material-icons" style="font-size: 2em;">layers</i>
														</div>
													</div>
												</div>
											@endforeach
											<div wire:loading class="col-12 text-center">
												<div class="spinner-grow text-dark" role="status">
													<span class="sr-only">Loading...</span>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
					@endif
				</div>


				@include('gamification.patients.quest-revive')

			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('reviveConfirm', (event) => {
		Swal.fire({
			title: event.detail.data['name'],
			// text: "Patient health will increased by revive amount",
			imageUrl: "/assets/svg/revive/"+event.detail.data['icon']+".png",
			imageWidth: 60,
			imageHeight: 'auto',
			imageAlt: event.detail.data['name'],
			showCancelButton: false,
			showCloseButton: true,
			confirmButtonColor: "#8f4ce8",
			confirmButtonText: "Use"
		})
		.then((result) => {
			if (result.isConfirmed) {
				Livewire.dispatch('reviveConfirmed');
			}
		});
	});
</script>