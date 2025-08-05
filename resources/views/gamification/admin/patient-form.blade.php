<div class="">
	<!-- Navbar -->
	<!-- End Navbar -->
	<div class="container-fluid py-4">
		<form wire:submit.prevent="submit">
			<div class="row">
				<div class="col-12 col-lg-4 mb-4">			
					<div class="card card-body mt-2">
						<h5 class="font-weight-normal mt-1">Patient: {{ $name ?? 'Name' }}</h5>
						<p class="mb-0 text-dark">{{ $description ?? 'descriptions' }}</p>
					</div>
					<div class="card card-body p-2 pb-3 mt-2">
						<div class="progress-wrapper">
							<div class="progress-info">
								<div class="progress-percentage">
									<span class="text-sm font-weight-normal">Health</span>
									<span class="text-xs font-weight-normal float-end mt-2">{{ $curr_health }}/100 HP</span>
								</div>
							</div>
							<div class="progress">
								<div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="{{ $curr_health }}" aria-valuemin="0" aria-valuemax="100" style="width: <?= $curr_health ?>%;"></div>
							</div>
						</div>
					</div>
					<div class="card card-body p-0 mt-2">
						<div class="row">
							<div class="col text-center">
								<div class="avatar avatar-md">
									<i class="material-symbols-outlined text-secondary">device_thermostat</i>
								</div>
								<p class="m-0 text-sm">Temperatur</p>
								<h3 class="text-gradient text-warning">
									{{ $temp }} <span class="text-lg ms-n2">°C</span>
								</h3>
							</div>
							<div class="col text-center">
								<div class="avatar avatar-md">
									<i class="material-symbols-outlined opacity-10 text-secondary">health_metrics</i>
								</div>
								<p class="m-0 text-sm">Heart Rate</p>
								<h3 class="text-gradient text-info">
									{{ $hr_rate }}
								</h3>
							</div>
							<div class="col text-center">
								<div class="avatar avatar-md">
									<i class="material-symbols-outlined opacity-10 text-secondary">oxygen_saturation</i>
								</div>
								<p class="m-0 text-sm">O<sub>2</sub> Saturation</p>
								<h3 class="text-gradient text-success">
									{{ $oxy_sat }}
									<span class="text-lg ms-n1">%</span>
								</h3>
							</div>
						</div>
					</div>
					<div class="card card-body p-0 mt-2">
						<div class="row">
							<div class="col text-center">
								<div class="avatar avatar-md">
									<i class="material-symbols-outlined opacity-10 text-secondary">blood_pressure</i>
								</div>
								<p class="m-0 text-sm">Blood Pressure</p>
								<h3 class="text-gradient text-warning">{{ $bl_press }}</h3>
							</div>
							<div class="col text-center">
								<div class="avatar avatar-md">
									<i class="material-symbols-outlined opacity-10 text-secondary">pulmonology</i>
								</div>
								<p class="m-0 text-sm">Respiratory Rate</p>
								<h3 class="text-gradient text-primary">{{ $resp_rate }}</h3>
							</div>
						</div>
					</div>
					
				</div>

				<div class="col-12 col-lg-8 mb-4">
					<div class="p-4">
						<div class="row">
							<div class="col-6">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" wire:model.live="isTrial" id="is-trial">
									<label class="custom-control-label text-bold text-warning" for="is-trial"><span wire:loading.remove>{{ $isTrial ? 'FOR TRIAL' : 'NOT TRIAL' }}</span><span wire:loading>Switching..</span></label>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-6">
								<div class="input-group input-group-static mb-4">
									<label>Patient Name</label>
									<input wire:model.blur="name" type="text" class="form-control @error('name')is-invalid @enderror">
									@error('name')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-6">
								<div class="row mt-4">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="radio" wire:model="sex" name="sex" value="female" id="genderField2">
											<label class="custom-control-label" for="genderField2">Female</label>
										</div>
									</div>
									<div class="col-6">
										<div class="form-check mb-3">
											<input class="form-check-input" type="radio" wire:model="sex" name="sex" value="male" id="genderField1">
											<label class="custom-control-label" for="genderField1">Male</label>
										</div>
									</div>
									@error('sex')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
								@error('gender')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
							</div>
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Age <span class="text-sm text-warning">(in years)</span></label>
									<input wire:model.blur="age" type="text" class="form-control @error('age')is-invalid @enderror">
									@error('age')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Case Title <span class="text-sm text-muted">(optional)</span></label>
									<input wire:model.blur="title" type="text" class="form-control @error('title')is-invalid @enderror">
									@error('title')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-3">
								<div class="input-group input-group-static mb-4">
									<label>Type <span class="text-sm text-muted">(optional)</span></label>
									<input wire:model.blur="type" type="text" class="form-control @error('type')is-invalid @enderror">
									@error('type')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
						<div class="input-group input-group-static mb-4">
							<label>Description</label>
							<textarea wire:model.blur="description" rows="4" class="form-control @error('description')is-invalid @enderror"></textarea>
							@error('description')
								<span class="text-xs text-warning">{{ $message }}</span>
							@enderror
						</div>
						<div class="row">
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Temperature</label>
									<input wire:model.blur="temp" type="text" class="form-control @error('temp')is-invalid @enderror">
									@error('temp')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Heart Rate</label>
									<input wire:model.blur="hr_rate" type="text" class="form-control @error('hr_rate')is-invalid @enderror">
									@error('hr_rate')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Oxy. Saturation</label>
									<input wire:model.blur="oxy_sat" type="text" class="form-control @error('oxy_sat')is-invalid @enderror">
									@error('oxy_sat')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Blood Pressure</label>
									<input wire:model.blur="bl_press" type="text" class="form-control @error('bl_press')is-invalid @enderror">
									@error('bl_press')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Respiratory Rate</label>
									<input wire:model.blur="resp_rate" type="text" class="form-control @error('resp_rate')is-invalid @enderror">
									@error('resp_rate')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Current Health</label>
									<input wire:model.blur="curr_health" type="text" class="form-control @error('curr_health')is-invalid @enderror">
									@error('curr_health')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="w-100 text-center" wire:loading wire:target="submit">
					<h5>Saving in progress..</h5>
				</div>
			</div> <!-- end row -->

			<div class="text-center">
				<a href="{{ route('patient-list') }}" class="btn bg-secondary text-white font-weight-bolder w-20 mb-0">Back</a>
				<button type="button" wire:click="submit('draft')" class="btn bg-gradient-secondary text-white font-weight-normal w-20 mb-0 {{ $keyToEdit ? 'd-none' : '' }}">Save as draft</button> 
				<button type="button" wire:click="submit('active')" class="btn bg-gradient-medsnapp text-white font-weight-bolder w-auto mb-0">{{ $keyToEdit ? 'Save changes'. ($status !== 'active' ? ' and activate' : '') : 'Submit' }}</button>
				@if($status == 'active')
				<button type="button" wire:click="submit('inactive')" class="btn bg-gradient-danger text-white font-weight-bolder w-10 mb-0">Inactivate</button>
				@endif
			</div>
		</form>
	</div>
</div>