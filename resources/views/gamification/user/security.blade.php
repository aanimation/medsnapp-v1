<div class="container-fluid py-2 px-sm-2 px-xl-4 px-xxl-12">
	<div class="row">
		<div class="col-lg-12 mt-lg-0 mt-4">
			<div class="card card-body with-border mb-4" id="profile">
				<div class="row justify-content-between">
					
				</div>
				<div class="row">
					<div class="col-lg-6 col-sm-auto ps-3">
						<div class="h-100">
							<h5 class="mb-1 font-weight-bolder">
								{{ strtoupper($username) }}
							</h5>
							<p class="mb-0 font-weight-normal text-sm">
								{{ $item->speciality }} - {{ 'level ' . $item->level }}
							</p>
						</div>
					</div>

					@if($item->is_active)
					<div class="col-lg-6 col-sm-auto">
						<div class="d-block ms-lg-3 float-end">
							@include('gamification.user.profile-tab')
						</div>
					</div>
					@endif

				</div>
			</div>

			<div class="row">
				<div class="col-12 col-lg-6 mt-lg-0 order-sm-2">
					<div class="card card-body with-border p-3">
						<h5 class="font-weight-normal mb-4">Change Password</h5>
						<div>
							<form wire:submit.prevent="updatePassword">
								@if(!$hasGoogleId)
								<label>Current Password
									@error('currentPassword')
									<span class='text-xs text-danger ms-1'>required</span>
									@enderror
								</label>
								<div class="input-group input-group-outline" style="border-radius: 0.375em;">	
									<input wire:model.live="currentPassword" type="{{ $passwordType }}" class="form-control text-white">
									<span wire:click.prevent="togglePasswordType" class="input-group-text cursor-pointer me-3" style="z-index: 99;"><i id="togglePassword" class="fa fa-eye{{$passwordType === 'text'? '-slash' : ''}}"></i></span>
								</div>
								<hr>
								@endif

								<label>Password
									@error('password')
									<span class='text-xs text-danger ms-1'>required</span>
									@enderror
								</label>
								<div class="input-group input-group-outline mb-3" style="border-radius: 0.375em;">
									<input wire:model.live="password" type="{{ $passwordType }}" class="form-control text-white">
									<span wire:click.prevent="togglePasswordType" class="input-group-text cursor-pointer me-3" style="z-index: 99;"><i id="togglePassword" class="fa fa-eye{{$passwordType === 'text'? '-slash' : ''}}"></i></span>
								</div>

								<label>Confirm Password
									@error('confirmPassword')
									<span class='text-xs text-danger ms-1'>required</span>
									@enderror
								</label>
								<div class="input-group input-group-outline mb-3" style="border-radius: 0.375em;">
									<input wire:model.live="confirmPassword" type="{{ $passwordType }}" class="form-control text-white">
									<span wire:click.prevent="togglePasswordType" class="input-group-text cursor-pointer me-3" style="z-index: 99;"><i id="togglePassword" class="fa fa-eye{{$passwordType === 'text'? '-slash' : ''}}"></i></span>
								</div>

								@if($password)
									<div class="d-flex">
										<ul class="list-unstyled text-xs my-1 w-50">
											<li><i class="fas {{in_array('mix', $errors->all()) ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>Upper &amp; lower case</li>
											<li><i class="fas {{in_array('num', $errors->all()) ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>One number</li>
										</ul>
										<ul class="list-unstyled text-xs my-1 w-50">
											<li><i class="fas {{in_array('sym', $errors->all()) ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>One special character</li>
											<li><i class="fas {{in_array('min', $errors->all()) ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>8 characters minimum</li>
										</ul>
										<ul class="list-unstyled text-xs my-1 w-50">
											@if($confirmPassword)
											<li><i class="fas {{in_array('same', $errors->all()) ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>Confirm password</li>
											@else
											<li><i class="fas fa-times-circle text-danger me-2"></i>Confirm password</li>
											@endif
										</ul>
										
									</div>
								@endif
								
								<div class="form-check form-check-info text-end ps-0 mt-3">
									<button type="submit" class="btn btn-md text-white bg-gradient-medsnapp py-2 mt-3 mb-0">
										Update<span wire:loading wire:target="updatePassword" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-6 mt-lg-0 order-sm-2">
					<div class="card card-body with-border p-3 h-100 mt-sm-4">
						<h5 class="font-weight-normal mb-4">Deactivate Account</h5>
						<p>This action is permanent and cannot be undone! After deactivating your account.</p>
						<p>After deactivating your account you will be loggen out and will not be able to access your statistics, currencies, referrals, and/or transactions anymore.</p>
						<button wire:click="deactivateAccount" type="button" class="btn btn-md text-white bg-gradient-medsnapp position-absolute bottom-1 end-3 py-2" wire:confirm.prompt="Are you sure?\n\nType {{ $email }} to confirm|{{ $email }}">Deactivate<span wire:loading wire:target="deactivateAccount" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
