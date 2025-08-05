<div wire:ignore.self class="modal fade" id="player-invens" tabindex="-1" role="dialog" aria-labelledby="player-invens" aria-hidden="true" data-bs-keyboard="false">
	<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
		<div class="modal-content">
			<button type="button" class="btn btn-sm btn-link text-white mb-0 position-absolute top-1 end-0 z-index-3" data-bs-dismiss="modal" aria-label="Close">
				<span class="material-symbols-outlined">close</span>
			</button>
			<div class="modal-body" style="height: 37em">
				<div class="row p-2 pt-sm-4">
					<ul id="custom-tab" class="nav nav-tabs mb-2">
						<li wire:click="changeType('investigation')" class="nav-item">
							<button class="nav-link px-5 py-1 {{ $currType == 'investigation' ? 'active' : '' }}">Investigation</button>
						</li>
						<li wire:click="changeType('treatment')" class="nav-item">
							<button class="nav-link px-5 py-1 {{ $currType == 'treatment' ? 'active' : '' }}">Treatment</button>
						</li>
						<li wire:click="changeType('recovery')" class="nav-item">
							<button class="nav-link px-5 py-1 {{ $currType == 'recovery' ? 'active' : '' }}">Recovery</button>
						</li>
					</ul>
				</div>
				<div class="row justify-content-center gx-0">
					<div class="col-lg-8 col-sm-12 overflow-auto max-height-vh-60">
						@if($inventories->count() == 0)
							<p class="text-center p-5">No {{$currType}} items, visit <a href="{{route('shop')}}"><strong>Shop</strong></a> to collect them</p>
						@endif
						@foreach($inventories as $item)
						<div wire:click="selectItem('{{$item->skey}}')" title="{{ $item->name }}" class="icon icon-xl icon-shape shadow text-center border-radius-xl position-relative m-2 cursor-pointer {{ $item->skey == ($currentItem->skey ?? '') ? 'bg-medsnapp' : 'bg-dark'}}">
							@if($item->type === 'recovery')
							<img width="45" height="auto" src="/assets/svg/revive/{{$item->icon}}.png" class="d-block mx-auto" style="margin-top: 20px;"/>
							@elseif($item->type === 'treatment')
							<span class="position-absolute text-xs text-white" style="top:50%;left:50%;transform:translate(-50%, -50%);">{{ Str::limit($item->name, 15) }}</span>
							<span class="position-absolute text-md text-secondary top-50 mt-3 translate-middle">{!! $item->specifications !!}</span>
							@else
							<img width="50" height="50" src="/assets/svg/{{$item->type}}/{{$item->name}}.svg" class="d-block mx-auto" style="margin-top: 23px;"/>
							@endif
							<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x{{$item->user_inv_amount}}</span>
						</div>
						@endforeach
					</div>

					<div class="col-md-4 col-12 pt-1">
						<div class="w-100">
							<span wire:loading wire:target="selectItem" class="spinner-border spinner-border-sm text-secondary" role="status" aria-hidden="true"></span>
						</div>
						@isset($currentItem)
							<div wire:loading.remove wire:target="selectItem" class="card card-body text-sm px-0 bg-dark">
								<div>
									@if($currentItem->type === 'recovery')
									<img width="80" height="auto" src="/assets/svg/revive/{{$currentItem->icon}}.png" class="d-block mx-auto"/>
									@elseif($currentItem->type === 'treatment')
									<img width="80" height="auto" src="/assets/img/small-logos/icon-bulb.svg" class="d-block mx-auto"/>
									@else
									<img width="80" height="80" src="/assets/svg/{{$currentItem->type}}/{{$currentItem->name}}.svg" class="d-block mx-auto"/>
									@endif
								</div>
								<hr>
								<h6 class="ps-3">{{ $currentItem->name }}</h6>
								<div class="list-group">
									<div class="list-group-item d-flex font-weight-bolder">
										<span class="w-25">Available</span>: {{ $currentItem->user_inv_amount <= 0 ? 0 : $currentItem->user_inv_amount }} pcs
									</div>
									@if($currentItem->specifications)
									<div class="list-group-item d-flex">
										<span class="w-25">Route</span>: {{ $currentItem->specifications }}
									</div>
									@endif
									<div class="list-group-item d-flex">
										<span class="w-25">Type</span>: {{ ucfirst($currentItem->type) }}
									</div>
									<div class="list-group-item d-flex">
										<span class="w-25">Category</span>: {{ $currentItem->category }}
									</div>
									<div class="list-group-item d-flex">
										<span class="w-25">Price</span>: {{ $currentItem->price }} coin{{$currentItem->price ? 's' : ''}}
									</div>
									
									@if($currentItem->description)
									<div class="list-group-item d-flex">
										<span class="w-25">Description</span>: {{ $currentItem->description ?? 'No description' }}
									</div>
									@endif
								</div>

								<button wire:click="buyItem('{{$currentItem->skey}}')" class="btn btn-md bg-gradient-medsnapp text-white font-weight-bolder w-50 mx-auto mt-3 mb-0 shadow"><span wire:loading.remove wire:target="buyItem">Buy</span><span wire:loading wire:target="buyItem" class="spinner-border spinner-border-sm mx-4" role="status" aria-hidden="true"></span></button>
							</div>
						@endisset
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
