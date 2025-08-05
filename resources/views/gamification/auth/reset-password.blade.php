<main class="main-content mt-0">
<div class="page-header min-vh-100">
	<div class="container" style="margin-top:-10rem;">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-4 col-md-6 mx-auto">
				<div class="text-center mb-4">
					<a href="{{ route('homepage') }}/?">
						<img width="200" height="auto" src="/assets/img/logos/medsnapp-svg.svg" class="img-responsive">
					</a>
				</div>
				<div class="card card-plain bg-dark-brown">
					<div class="card-header pb-2 text-center">
						<h4 class="font-weight-bolder">Reset Password</h4>
					</div>
					<div class="card-body pt-1">
						@if (Session::has('email'))
						<div class="alert alert-danger alert-dismissible text-white" role="alert">
							<span class="text-sm">{{ Session::get('email') }}</span>
							<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						@endif
						<form wire:submit.prevent="update" class="text-start">
							<div
								class="input-group input-group-outline mt-3 is-filled">
								<label class="form-label">Email</label>
								<input wire:model="email" type="email" class="form-control text-white">
							</div>
							@error('email')
							<p class='text-danger inputerror'>{{ $message }} </p>
							@enderror

							<div
								class="input-group input-group-outline mt-3 @if(strlen($password ?? '') > 0) is-filled @endif">
								<label class="form-label">New Password</label>
								<input wire:model.live="password" type="{{$passwordType}}" class="form-control text-white">
								<span wire:click.prevent="togglePasswordType" class="input-group-text cursor-pointer me-3" style="z-index: 99;"><i id="togglePassword" class="fa fa-eye{{$passwordType === 'text'? '-slash' : ''}}"></i></span>
							</div>

							@if($password)
								<div class="d-flex">
									<ul class="list-unstyled text-xs my-1 w-50">
										<li><i class="fas {{in_array('min', $errors->all()) ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>8 characters minimum</li>
										<li><i class="fas {{in_array('mix', $errors->all()) ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>Lower &amp; upper case</li>
									</ul>
									<ul class="list-unstyled text-xs my-1 w-50">
										<li><i class="fas {{in_array('num', $errors->all()) ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>At least one number</li>
										<li><i class="fas {{in_array('sym', $errors->all()) ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>At least one symbol</li>
									</ul>
								</div>
							@endif

							<div class="text-center">
								<button type="submit" class="btn bg-gradient-medsnapp text-white w-100 my-4 mb-2">Update</button>
							</div>
							<p class="mt-4 mb-2 text-sm text-center">
								Don't have an account?
								<a href="{{ route('register') }}" class="text-light font-weight-bold">Sign Up</a>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</main>
		