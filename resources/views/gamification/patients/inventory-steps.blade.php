<div class="card multisteps-form m-0 mb-4">
	<div class="card card-body with-border p-3 px-sm-1 max-height-500">
		<div class="row px-sm-3">
			<h5 class="font-weight-normal mt-1">Clinical Assessment</h5>

			<!-- Mobile -->
			<div class="dropdown d-md-none">
				<button class="btn bg-gradient-medsnapp text-white dropdown-toggle w-sm-100 w-md-60" type="button" id="dropdownInv" data-bs-toggle="dropdown" aria-expanded="false">
					<span wire:loading.remove wire:target="setStep">{{ $step == 1 ? '1. Examinations' : ($step == 2 ? '2. Investigations' : '3. Treatment') }}</span>
					<span wire:loading wire:target="setStep" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
				</button>
				<ul class="dropdown-menu" aria-labelledby="dropdownInv">
					<li><div wire:click="setStep(1)" class="dropdown-item text-white">1. Examinations</div></li>
					<li><div wire:click="setStep(2)" class="dropdown-item text-white">2. Investigations</div></li>
					<li><div wire:click="setStep(3)" class="dropdown-item text-white">3. Treatment</div></li>
				</ul>
			</div>
			<!-- End Mobile -->

			<div class="col-12 d-sm-none">
				<div class="d-flex pt-4 pb-3">
					<button wire:click.prevent="changeStep('prev')" class="btn btn-icon-only rounded-circle w-5 p-0 mb-0 {{ $left ? '' : 'disabled' }}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Previous">
						<span class="btn-inner--icon"><i class="material-symbols-outlined" style="color: #8949e0;font-size: 50px;">arrow_left</i></span>
					</button>
					<div class="w-90 multisteps-form__progress">
						<button wire:click.prevent="setStep(1)" id="exa" class="multisteps-form__progress-btn {{$step == 1 ? 'step-active' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$quest->examinationMax-$userQuest->examination}} left">
							<span>Examinations</span>
						</button>
						<button wire:click.prevent="setStep(2)" id="inv" class="multisteps-form__progress-btn {{$step == 2 ? 'step-active' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$quest->investigationMax-$userQuest->investigation}} left">
							<span>Investigations</span>
						</button>
						<button wire:click.prevent="setStep(3)" id="tre" class="multisteps-form__progress-btn {{$step == 3 ? 'step-active' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$quest->treatmentMax-$userQuest->treatment}} left">
							<span>Treatment</span>
						</button>
					</div>
					<button wire:click.prevent="changeStep('next')" class="btn btn-icon-only w-5 p-0 mb-0 {{ $right ? '' : 'disabled' }}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Next">
						<span class="btn-inner--icon"><i class="material-symbols-outlined" style="color: #8949e0;font-size: 50px;float: right;">arrow_right</i></span>
					</button>
				</div>
			</div>
		</div>

		<div class="row">
			<!-- Examinations -->
			@if($step == 1)
			<div class="badge" style="text-transform: none;">Select up to 5 examinations</div>
			<div class="col-12">
				<div class="row justify-content-center gx-0 mx-xxl-8 mb-4">
					@foreach($invs->where('usage_count', 0) as $idx => $item)
						<div class="col-auto">
							<div wire:key="card-examination-{{ $idx }}" title="{{ $item->name }}" class="icon icon-inv icon-shape bg-dark{{$item->history_count>0 ? '-used' : ''}} shadow text-center border-radius-xl position-relative cursor-pointer m-1" wire:click="openInventoryModal('{{ $item->skey }}', 'examination', '', {{$item->usage_count>0}})">
							  <img width="50" height="50" src="/assets/svg/{{$item->type}}/{{$item->name}}.svg" class="d-block mx-auto" style="margin-top: 20px;"/>
							  <div class="mx-auto text-center text-white text-xs pt-1">{{ $item->name }}</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			@endif
			<!-- end Examinations -->

			<!-- Investigations -->
			@if($step == 2)
			<div class="badge" style="text-transform: none;">Select up to 10 investigations</div>
			<div class="col-12">
				<div class="d-block text-center mx-xxl-8">
					@if(!$isSearch)
						@foreach($cats as $cat)
							<button wire:click="changeCategory('{{ $cat }}')" class="btn btn-sm bg-gradient-medsnapp text-white me-2 w-lg-20 {{ $currCat == $cat ? 'disabled' : '' }}">{{ $cat }}</button>
						@endforeach
					@endif
					<button wire:click="toggleSearch('investigation')" class="btn btn-sm bg-gradient-medsnapp" type="button">
						<i class="material-icons" style="font-size:1.1rem; color:white;">search{{ !$isSearch ? '' : '_off'}}</i>
					</button>
					@if($isSearch)
					<div class="input-group input-group-static w-50 mx-auto mb-3">
						<input wire:model.live="search" type="search" class="form-control" placeholder="search">
					</div>
					@endif
				</div>
				<div class="row justify-content-center min-height-200 max-height-250 overflow-y-auto gx-0 mx-xxl-8">
					@foreach($invs->where('usage_count', 0) as $idx => $item)
						<div wire:loading.remove wire:target="changeCategory" class="col-auto">
							<div wire:key="card-investigation-{{ $idx }}" title="{{ $item->name }}" class="icon icon-inv icon-shape bg-dark{{$item->history_count>0 ? '-used' : ''}} shadow text-center border-radius-xl position-relative m-1 cursor-pointer" wire:click="openInventoryModal('{{ $item->skey }}', 'investigation', '{{$quest->sex}}', {{$item->usage_count>0}})">
								<img width="50" height="50" src="/assets/svg/{{$item->type}}/{{$item->name}}.svg" class="d-block mx-auto" style="margin-top: 20px;"/>
								<div class="mx-auto text-center text-white text-xs pt-1">{{ $item->name }}</div>
								@if($item->user_inv_amount > 0)
								<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x{{$item->user_inv_amount}}</span>
								@endif
							</div>
						</div>
					@endforeach

					<div wire:loading wire:target="changeCategory, search" class="col-12 text-center">
						<div class="spinner-grow text-dark" role="status">
							<span class="sr-only">Loading...</span>
						</div>
					</div>

					@if($invs->count() < $invs->total())
						<button wire:loading.remove wire:target="changeCategory" wire:click="loadMore('investigation')" wire:loading.class="d-none" class="btn btn-link text-white mt-md-4">
							<span wire:loading.remove wire:target="loadMore">Load More</span>
							<div wire:loading wire:target="loadMore" class="spinner-grow text-dark" role="status"></span>
						</button>
					@endif
				</div>
			</div>
			@endif
			<!-- end Investigations -->

			<!-- Threatments -->
			@if($step == 3)
				<div class="px-sm-1">
					@livewire('patient.inv-treatment', ['userQuestId' => $userQuest->id])
				</div>
			@endif
			<!-- end Threatments -->

		</div> <!-- end row -->
	</div>
</div>