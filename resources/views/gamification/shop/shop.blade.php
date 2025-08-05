<div style="min-height: 80vh!important;">
	<div class="container-fluid px-sm-2 py-2 px-xl-4 px-xxl-12">

		<!-- Onboarding only -->
		<div class="card card-body with-border mb-4 {{session()->has('next-route-num') ? '' : 'd-none'}}">
			<div class="row">
				<div class="col-12 col-sm-auto ps-3">
					<h5 class="font-weight-normal">Top Tip</h5>
					<div class="h-100 text-center">
						<p class="mb-0 font-weight-normal">
							Stock up on your medical inventory items before treating your first patient.
						</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 mb-2">
				<div class="card card-body with-border p-3 min-vh-100">
					<div wire:visible class="d-flex">
						<h5 class="w-50 font-weight-normal mb-4">Shop</h5>
						<div class="d-sm-none w-sm-40 w-md-30 w-lg-30 w-40">
							<div class="input-group input-group-static max-width-300 mb-1">
								<i class="fa fa-search position-absolute" style="top:12px;"></i>
								<input wire:model.live="search" type="search" class="form-control ps-4" placeholder="search">
							</div>
						</div>
						<div class="w-sm-50 w-lg-20">
							@livewire('shop.shop-coin')
						</div>
					</div>
					<div class="row justify-content-between gx-0">
						<div class="col-md-12">
							<!-- Mobile -->
							<div class="d-md-none mx-sm-auto mb-sm-4">
								<div class="input-group input-group-static mb-1">
									<i class="fa fa-search position-absolute" style="top:12px;"></i>
									<input wire:model.live="search" type="search" class="form-control ps-4" placeholder="search">
								</div>
							</div>

							<div class="dropdown d-md-none">
								<button class="btn btn-sm bg-gradient-dark dropdown-toggle w-sm-100 w-md-60" type="button" id="dropdownInv" data-bs-toggle="dropdown" aria-expanded="false">
									<span wire:loading.remove wire:target="changeType">{{ $tabs[$currType] }}</span>
									<span wire:loading wire:target="changeType" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
								</button>
								<ul class="dropdown-menu" aria-labelledby="dropdownInv">
									@foreach($tabs as $key => $tab)
									<li><div wire:click="changeType('{{$key}}')" class="dropdown-item text-white {{ ($currType == $key || $key == 'all') ? 'd-none' : '' }}">{{$tab}}</div></li>
									@endforeach
								</ul>
							</div>
							<!-- End Mobile -->

							<div class="d-sm-none my-lg-4">
								<ul id="custom-tab" class="nav nav-tabs">
									@foreach($tabs as $key => $tab)
									<li wire:click="changeType('{{$key}}')" class="nav-item {{ $key == 'all' ? 'd-none' : '' }}">
										<button class="nav-link px-xl-5 px-lg-4 px-md-2 py-1 {{ $currType == $key ? 'active' : '' }}">{{ $tab }}</button>
									</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
					<div class="row justify-content-center gx-0">
						<div wire:loading wire:target="changeType" class="col-md-8 col-12 text-center mt-5">
							<div class="spinner-grow text-dark" role="status">
								<span class="sr-only">Loading...</span>
							</div>
						</div>
						@if($isSearch)
						<div class="col-md-8 col-12">
							<div class="input-group input-group-static w-50 mx-auto mb-3">
								<input wire:model.live="search" type="search" class="form-control" placeholder="search">
							</div>
						</div>
						@endif
						<div wire:loading.remove wire:target="changeType" class="col-12">
							@if($currType == 'investigation')
								<!-- Mobile -->
								<div class="dropdown d-sm-block d-lg-none mt-md-3">
									<button class="btn btn-sm bg-gradient-medsnapp dropdown-toggle w-100 w-md-40" type="button" id="dropdownInvCat" data-bs-toggle="dropdown" aria-expanded="false">
										<span wire:loading.remove wire:target="changeCat" class="text-white">{{ $currCat ?? 'Select Sub' }}</span>
										<span wire:loading wire:target="changeCat" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownInvCat">
										<li><div wire:click="changeCat('Blood Tests')" class="dropdown-item text-white">Blood Tests</div></li>
										<li><div wire:click="changeCat('Urinary Tests')" class="dropdown-item text-white">Urinary Tests</div></li>
										<li><div wire:click="changeCat('Imaging')" class="dropdown-item text-white">Imaging</div></li>
										<li><div wire:click="changeCat('Others')" class="dropdown-item text-white">Others</div></li>
									</ul>
								</div>
								<!-- End Mobile -->

								<div class="d-none d-lg-block mt-sm-4">
									<button wire:click.prevent="changeCat('Blood Tests')" class="btn btn-sm bg-gradient-medsnapp text-white me-lg-2 w-100 w-lg-15 {{ $currCat == 'Blood Tests' ? 'disabled' : '' }}">Blood Tests</button>
									<button wire:click.prevent="changeCat('Urinary Tests')" type="button" class="btn btn-sm bg-gradient-medsnapp text-white me-lg-2 w-100 w-lg-15 {{ $currCat == 'Urinary Tests' ? 'disabled' : '' }}">Urinary Tests</button>
									<button wire:click.prevent="changeCat('Imaging')" type="button" class="btn btn-sm bg-gradient-medsnapp text-white me-lg-2 w-100 w-lg-15 {{ $currCat == 'Imaging' ? 'disabled' : '' }}">Imaging</button>
									<button wire:click.prevent="changeCat('Others')" type="button" class="btn btn-sm bg-gradient-medsnapp text-white me-lg-2 w-100 w-lg-15 {{ $currCat == 'Others' ? 'disabled' : '' }}">Others</button>
								</div>
							@elseif($currType == 'treatment')
								<!-- Mobile -->
								<div class="dropdown d-sm-block d-lg-none">
									<button class="btn btn-sm bg-gradient-medsnapp dropdown-toggle w-100" type="button" id="dropdownInvCat" data-bs-toggle="dropdown" aria-expanded="false">
										<span wire:loading.remove wire:target="changeCat" class="text-white">{{ $currCat ?? 'Select Sub' }}</span>
										<span wire:loading wire:target="changeCat" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="dropdownInvCat">
										<li><div wire:click="changeCat('Pharmacological')" class="dropdown-item text-white">Pharmacological</div></li>
										<li><div wire:click="changeCat('Non-Pharmacological')" class="dropdown-item text-white">Non-Pharmacological</div></li>
									</ul>
								</div>
								<!-- End Mobile -->

								<div class="d-sm-none d-block mt-sm-4 ms-lg-3">
									<button wire:click.prevent="changeCat('Pharmacological')" class="btn btn-sm bg-gradient-medsnapp text-white me-2 w-lg-25 w-100 {{ $currCat == 'Pharmacological' ? 'disabled' : '' }}">Pharmacological</button>
									<button wire:click.prevent="changeCat('Non-Pharmacological')" class="btn btn-sm bg-gradient-medsnapp text-white me-2 w-lg-25 w-100 {{ $currCat == 'Non-Pharmacological' ? 'disabled' : '' }}">Non-Pharmacological</button>
								</div>
							@else
								<div class="d-none ms-3">
									<button wire:click.prevent="changeCat('all')" class="btn btn-sm bg-gradient-medsnapp text-white me-2 w-30 {{ $currCat == 'all' ? 'disabled' : '' }}">All</button>
								</div>
							@endif
							
							<div wire:loading wire:target="changeCat" class="col-12 text-center mt-5">
								<div class="spinner-grow text-dark" role="status">
									<span class="sr-only">Loading...</span>
								</div>
							</div>
							
							<div wire:loading.remove wire:target="changeCat" class="text-sm-center" style="line-height: 14px;">
							@foreach ($inventories as $idx => $item)
							<div title="{{ $item->name }}" wire:key="item-{{$idx}}" class="icon icon-inv-xxl icon-shape shadow text-center text-white border-radius-xl position-relative m-1 cursor-pointer {{ $item->skey == ($currentItem->skey ?? '') ? 'bg-medsnapp' : 'bg-dark'}}" wire:click="selectItem('{{$item->skey}}', {{$item->has_sibling}})">
								@if($item->type === 'currency')
								<img width="45" height="auto" src="/assets/svg/ui/{{$item->icon}}.svg" class="d-block mx-auto mt-4"/>
								<span class="position-absolute text-sm start-50 translate-middle" style="top:71%;">{{ $item->name }}</span>
								@elseif($item->type === 'recovery')
								<img width="45" height="auto" src="/assets/svg/revive/{{$item->icon}}.png" class="d-block mx-auto mt-3" title="{{$item->name}}" />
								<span class="position-absolute text-sm start-50  translate-middle" style="top:71%;">{{ ucfirst($item->icon) }}</span>
								@elseif($item->type === 'treatment')
								<span class="position-absolute text-md lh-1 top-50 start-50 translate-middle">{{ $item->name }}</span>
								@else
								<img width="60" height="60" src="/assets/svg/{{$item->type}}/{{$item->name}}.svg" class="d-block mx-auto mt-3"/>
								<span class="position-absolute text-sm lh-1 start-50 translate-middle" style="top:71%;">{{ $item->name }}</span>
								@endif

								@if($item->has_sibling)
								<span class="text-sm position-absolute bottom-0 end-0 opacity-3" style="padding: 3px 6px; margin-bottom: 5px;">
									<i class="material-icons" style="font-size: 1.65em;">layers</i>
								</span>
								@elseif($item->type === 'currency')
								<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md d-none" style="padding: 3px 6px;">
									<span class="text-white">£{{ $item->price }}</span>
								</span>
								@else
								<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">
									<span class="text-white">{{ $item->price }}</span>
									<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="18" height="18" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 18 18" xml:space="preserve" class=""><g><path fill="#ffbe39" d="M493.176 274.813c0 130.983-106.168 237.184-237.201 237.184-131 0-237.15-106.2-237.15-237.184 0-130.975 106.15-237.184 237.15-237.184 131.033 0 237.201 106.209 237.201 237.184z" opacity="1" data-original="#fbb040" class=""></path><path fill="#e38c00" d="M270.676 435.463c-131.001 0-196.551-72.533-233.001-111.434v43.566c10.767 25.301 25.8 48.334 44.2 68.234v-43.9c15.716 17 33.833 31.699 53.9 43.533v43.783a237.552 237.552 0 0 0 44.2 20.25v-43.733c17.184 5.8 35.2 9.8 53.9 11.533v43.634c7.3.666 14.65 1.066 22.1 1.066 7.467 0 14.85-.4 22.135-1.066v-43.634c18.699-1.733 36.715-5.733 53.898-11.533v43.7a235.757 235.757 0 0 0 44.201-20.217v-43.783c20.066-11.834 38.184-26.533 53.9-43.533v43.9c18.398-19.9 33.449-42.934 44.215-68.234v-43.566c-25.533 17.834-72.615 111.434-203.648 111.434zm-157.651-99.834c-9.684-21.633-15.2-45.566-15.2-70.808 0-95.9 77.717-173.65 173.634-173.65 59.332 0 111.666 29.8 142.982 75.191-12.933-70.108-97.298-117.041-167.966-117.041-95.9 0-177.767 86.866-177.767 182.758 0 36.567 2.834 83.2 44.317 103.55z" opacity="1" data-original="#f7941e" class=""></path><path fill="#fce800" d="M255.975.004c-131 0-237.15 106.2-237.15 237.175 0 131.018 106.15 237.185 237.15 237.185 131.033 0 237.201-106.167 237.201-237.185C493.176 106.204 387.008.004 255.975.004zm0 410.826c-95.9 0-173.633-77.75-173.633-173.651 0-95.892 77.733-173.649 173.633-173.649 95.918 0 173.668 77.758 173.668 173.649 0 95.901-77.75 173.651-173.668 173.651z" opacity="1" data-original="#f9ed32" class=""></path></g></svg>
								</span>
								@endif
							</div>
							@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		@livewire('shop.shop-modal')
		@livewire('shop.shop-route-modal')

		@livewire('shop.purchase')
	</div>
</div>
