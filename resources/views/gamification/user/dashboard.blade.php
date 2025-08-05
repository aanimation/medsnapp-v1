<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2 px-sm-2 px-xl-4 px-xxl-12">
		<div class="row">
			<div class="col-12 col-lg-6 mb-4">
				@livewire('user.attributes')
			</div>
			<div class="col-12 col-lg-6 mb-4">
				@livewire('user.levels')
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-lg-4 mb-sm-4 mb-2">
				@livewire('leaderboard')
			</div>
			<div class="col-12 col-lg-8 mb-sm-4">
				<div class="card card-body p-0 h-100" style="background: transparent!important;">
					@livewire('user.badges')
					@livewire('user.inventory')
				</div>
			</div>
		</div>
		{{-- @include('gamification.modal') --}}
	</div>
</div>

@push('js')
	@production
	<script>
	  fpr("referral",{email:"{{ auth()->user()->email }}"});
	  fpr("referral",{uid:"{{ auth()->id() }}"})
	</script>
	@endproduction
@endpush