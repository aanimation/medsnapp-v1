<style type="text/css">
	.input-group input {
		color: white!important;
	}

	.moving-tab {
		display: none;
	}

	button.nav-link:not(.active) {
		color: #8a95a7!important;
	}
</style>

<div class="row">
	<div class="col-lg-6 col-12 pe-lg-4">
		<p>Reach out to our team for support. We'd be more than happy to answer and or follow up your questions!</p>
	</div>

	<div class="col-lg-6 col-12">
		<form wire:submit.prevent="submitMessage">
			<label class="form-label">Subject *</label>
			@error('subject')
				<span class="ms-2 text-xs text-warning">{{ $message }}</span>
			@enderror
			<div class="input-group input-group-outline mb-3">
				<input wire:model="subject" type="text" class="form-control">
			</div>

			<label class="form-label">Message *</label>
			@error('message')
				<span class="ms-2 text-xs text-warning">{{ $message }}</span>
			@enderror
			<div class="input-group input-group-outline mb-3">
				<textarea wire:model="message" rows="4" class="form-control"></textarea>
			</div>

			<label class="form-label">Reason for reaching out *</label>
			@error('part')
				<span class="ms-2 text-xs text-warning">{{ $message }}</span>
			@enderror
			<div class="input-group input-group-outline mb-3">
				<select wire:model="part" class="form-control text-white">
					<option value="" class="d-none">Select an Option</option>
					@foreach($parts as $part)
						<option value="{{ $part }}">{{ ucfirst($part) }}</option>
					@endforeach
				</select>
			</div>

			<label class="form-label">Priority</label>
			@error('priority')
				<span class="ms-2 text-xs text-warning">{{ $message }}</span>
			@enderror
			<div class="input-group input-group-outline mt-0 mb-3">
				<select wire:model="priority" class="form-control text-white">
					<option value="" class="d-none">Select an Option</option>
					@foreach($priors as $prio)
						<option value="{{ $prio }}">{{ ucfirst($prio) }}</option>
					@endforeach
				</select>
			 </div>

			 <button type="submit" class="btn btn-sm bg-gradient-medsnapp text-white w-sm-100 mt-sm-4">Submit<span wire:loading wire:target="submitMessage" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
		</form>
	</div>
</div>
