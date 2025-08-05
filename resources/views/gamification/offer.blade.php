<div style="min-height: 80vh!important;">

	<div class="container-fluid py-5">

		<div class="row mb-5">
			<div class="col-8 mx-auto text-center">
				<h4 class="opacity-6">Choose your best plan.</h4>
			</div>
		</div>

		<div class="row justify-content-center">
			@foreach($items as $item)
			<div class="col-lg-3 mb-lg-0 mb-4">
				<div class="card {{ $loop->index == 1 ? 'border-offer' : '' }} shadow-lg h-100">
					<h3 class="text-white mx-auto mt-4">{{ $item->tier_name}}</h3>
					@if($loop->index == 1)
					<div class="position-absolute text-md" style="top:2.5em; right: 2em; font-weight: 600;background-color: white;color:#8C31E8; padding: 4px 12px; border-radius: 7px;">-25%</div> 
					@endif
					@if($currentSubscribedId === $item->id)
					<div class="ribbon ribbon-triangle ribbon-top-start border-primary">
						<div class="ribbon-icon mt-n4 ms-n3">
							<i class="fa fa-check text-success"></i>
						</div>
					</div>
					@endif
					<div class="card-header ribbon ribbon-top text-center pt-4 pb-3">
						{{--
						@if($loop->index == 1)
						<div class="ribbon-label bg-primary">Recommended</div>
						@endif
						--}}
						<h2 class="font-weight-bold mt-2">
							@if($loop->index == 1)
							<span class="align-top me-0 text-muted text-lg">£</span>
							<span class="pe-3 text-decoration-line-through text-muted">
								<small class="text-lg align-top me-1"></small>16
							</span>
							@endif
							<small class="text-lg align-top me-1">£</small>{{ abs($item->price) }}<small class="text-lg">/ month</small></h2>
						<h6 class="text-white mx-auto my-3">{{ json_decode($item->features)->total_price }}</h6>

						@if(abs($item->price) == 0)
						<a href="{{route('player-bills')}}" class="btn bg-gradient-medsnapp text-white d-lg-block mt-3 mb-0">
							Get Started
						</a>
						<span class="border-radius-bottom-end-pill position-absolute top-0 start-0 bg-primary px-3 pe-4 py-1 text-white" style="border-radius: 1.2em 0 1.2em 0!important;">{{auth()->user()->free_tier_left_days}} day left</span>
						{{--
						@elseif($item->tier_name == 'Groups')
						<a href="mailto:contact@medsnapp.com" wire:key="{{strtolower($item->tier_name)}}" class="btn bg-gradient-{{$item->id === $currentSubscribedId ? 'dark': 'medsnapp'}} text-white d-lg-block mt-3 mb-0 w-100 {{ $item->id === $currentSubscribedId ? 'disabled' : ''}}">
							Contact Us
						</a>
						--}}
						@else
						<button wire:key="{{strtolower($item->tier_name)}}" wire:click="purchaseItem('{{ $item->tier_code }}')" class="btn bg-gradient-{{ ($item->id === $currentSubscribedId && !auth()->user()->hasExpired) ? 'dark': 'medsnapp'}} text-white d-lg-block mt-3 mb-0 w-100 {{ ($item->id === $currentSubscribedId && !auth()->user()->hasExpired) ? 'disabled' : ''}}">
							{{ auth()->user()->hasExpired ? 'Extend' : 'Upgrade' }}
							<span wire:loading wire:target="purchaseItem" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
						</button>
						@endif
					</div>
					<div class="card-body text-lg-start text-center pt-0">
						<div class="text-center">
							<h5 class="text-white my-3 mx-auto">{{ $item->tier_desc }}</h5>
						</div>
						@foreach(json_decode($item->features)->items as $benefit)
						<div class="d-flex justify-content-lg-start justify-content-center p-2">
							<i class="material-icons my-auto">done</i>
							<span class="ps-3">{{$benefit}}</span>
						</div>
						@endforeach

						@if($loop->index == 1)
						<h6 class="text-center text-white mx-auto my-3">Limited to first 100 Premium Users</h6>
						<div class="d-flex justify-content-lg-start justify-content-center p-2">
							<i class="material-icons my-auto">done</i>
							<span class="ps-3">25% discount</span>
						</div>

						<div class="d-flex justify-content-lg-start justify-content-center p-2">
							<i class="material-icons mt-1">done</i>
							<span class="ps-3">MedSnapp Affiliate Scheme - £20/referral</span>
						</div>

						<div class="d-flex justify-content-lg-start justify-content-center p-2">
							<i class="material-icons my-auto">done</i>
							<span class="ps-3">MedSnapp Merch (T-shirt)</span>
						</div>

						<div class="d-flex justify-content-lg-start justify-content-center p-2">
							<i class="material-icons my-auto">done</i>
							<span class="ps-3">Exclusive First 100 User Badge</span>
						</div>
						@endif
					</div>
				</div>
			</div>
			@endforeach
		</div>			
		
		<div class="row mt-5">
			<div class="col-8 mx-auto text-center">
				<h4 class="opacity-9">100% Money Back Guarantee</h4>
				<p>We’re so confident You’ll Love MedSnapp that If you’re not 100% satisfied, email us <u>within 30 days of purchase</u> and we’ll give you a full refund.</p>
			</div>
		</div>
	</div>

</div>