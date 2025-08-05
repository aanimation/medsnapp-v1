<div class="d-flex align-items-center justify-content-center py-20">
	<form id="waitlist-form" wire:submit="submitForm" class="text-center">
		<div class="row g-2">
	  		<div class="col-auto">
				<input name="email" type="text" wire:model.blur="email" placeholder="Enter your email..."  wire:dirty.class="border-yellow">
				@error('email')
					<div class="position-absolute">
						<span class="text-danger">{{ $message }}</span>
					</div>
				@enderror

				@if(session('success'))
					<div class="position-absolute">
						<span class="text-success">{{session('success')}}</span>
					</div>
				@endif

				@if(session('error'))
					<div class="position-absolute">
						<span class="text-warning">{{session('error')}}</span>
					</div>
				@endif
				<div class="position-absolute">
					<span class="text-info" wire:dirty wire:target="email">unsubmitted...</span>
				</div>
			</div>
	  		<div class="col-auto">
				<button type="submit" class="btn btn-md btn-medsnapp">Get Early Access</button>
			</div>
		</div>
	</form>
</div>