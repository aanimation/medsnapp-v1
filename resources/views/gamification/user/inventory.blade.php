<div class="card card-body with-border p-2 mb-2" style="min-height: 53vh !important;">
	<div class="d-flex mt-1">
		<h5 class="w-70 opacity-7 font-weight-normal ms-2 mt-1 mb-4">Inventory</h5>
		@if($hasInventories)
			<div title="show all inventories" class="w-30 text-xs text-end text-muted cursor-pointer pe-2 d-sm-none" data-bs-toggle="modal" data-bs-target="#player-invens">Show All</div>
			@livewire('user.inventory-modal')
		@endif
	</div>
	<div class="row">
		<!-- Mobile -->
		<div class="dropdown d-md-none">
			<button class="btn btn-sm bg-gradient-dark dropdown-toggle w-sm-100 w-md-60" type="button" id="dropdownInv" data-bs-toggle="dropdown" aria-expanded="false">
				<span wire:loading.remove wire:target="changeType">{{ ucfirst($currType) }}</span>
				<span wire:loading wire:target="changeType" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="dropdownInv">
				<li><div wire:click="changeType('investigation')" class="dropdown-item text-white {{ $currType == 'investigation' ? 'd-none' : '' }}">Investigation</div></li>
				<li><div wire:click="changeType('treatment')" class="dropdown-item text-white {{ $currType == 'treatment' ? 'd-none' : '' }}">Treatment</div></li>
				<li><div wire:click="changeType('recovery')" class="dropdown-item text-white {{ $currType == 'recovery' ? 'd-none' : '' }}">Recovery</div></li>
			</ul>
		</div>
		<!-- End Mobile -->
		<div class="d-sm-none px-4 mb-lg-3">
			<ul id="custom-tab" class="nav nav-tabs">
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
	</div>
	<div class="row justify-content-center gx-0 overflow-y-auto max-height-400">
		<div class="col-12">
			@if($inventories->count() == 0)
				<p class="text-center p-5">No {{$currType}} items in inventory.</p>
			@endif
			@foreach($inventories as $item)
			<div wire:click.prevent="setKeyItemInv('{{$item->skey}}')" title="{{ $item->name }}" class="icon icon-inv-xxl icon-shape bg-dark shadow text-center border-radius-xl position-relative m-2 cursor-pointer"  data-bs-toggle="modal" data-bs-target="#player-invens">
				@if($item->type === 'recovery')
				<img width="45" height="auto" src="/assets/svg/revive/{{$item->icon}}.png" class="d-block mx-auto mt-4"/>
				<span class="position-absolute text-sm text-white top-75 start-50 translate-middle">{{ ucfirst($item->icon) }}</span>
				@elseif($item->type === 'treatment')
				<span class="position-absolute text-md text-white top-50 start-50 translate-middle">{{ $item->name }}</span>
				<span class="position-absolute text-md text-secondary top-50 mt-4 translate-middle">{!! $item->specifications !!}</span>
				@else
				<img width="60" height="60" src="/assets/svg/{{$item->type}}/{{$item->name}}.svg" class="d-block mx-auto" style="margin-top: 23px;"/>
				<span class="position-absolute text-sm lh-1 text-white top-75 start-50 translate-middle">{{ $item->name }}</span>
				@endif
				<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x{{$item->user_inv_amount}}</span>
			</div>
			@endforeach
		</div>
	</div>
</div>