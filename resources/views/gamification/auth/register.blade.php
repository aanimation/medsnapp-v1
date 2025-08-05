<main class="main-content mt-0">
	<section>
		<div class="container-fluid">
			<div class="row vh-100 gx-5">
				<div class="col-lg-6 col-sm-12 my-sm-5 my-md-8 my-auto mt-xxl-12 px-auto">
					<div class="text-center mb-4">
						<a href="{{ route('homepage') }}">
							<img width="200" height="auto" src="/assets/img/logos/medsnapp-svg.svg" class="img-responsive">
						</a>
					</div>
					<div class="card card-plain bg-dark-brown w-xxl-40 w-xl-60 w-lg-80 w-md-50 w-100 mx-auto">
						<div class="card-header pb-2">
							<h4 class="font-weight-bolder">Sign Up</h4>
						</div>
						<div class="card-body pt-1">
							<form wire:submit.prevent="store">
								@if (Session::has('status'))
								<div class="alert alert-warning alert-dismissible text-white bg-gradient-dark" role="alert">
									<span class="text-sm">{{ Session::get('status') }}</span>
									<button type="button" class="btn-close text-lg py-3 opacity-10"
										data-bs-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								@endif

								<div class="input-group input-group-outline mt-3 @if(strlen($email ?? '') > 0) is-filled @endif">
									<label class="form-label">Email</label>
									<input wire:model.live="email" type="email"  class="form-control text-white">
								</div>
								@error('email')
								<p class='text-xs mt-1 mb-0'>{{ $message }} </p>
								@enderror
								{{--
								@if($email)
								<ul class="list-unstyled text-xs my-1 w-50">
									<li><i class="fas {{$errors->has('email') ? 'fa-times-circle text-danger' : 'fa-check-circle text-success'}} me-2"></i>Valid email format</li>
								</ul>
								@endif
								--}}

								<div class="input-group input-group-outline mt-3 @if(strlen($password ?? '') > 0) is-filled @endif" style="border-radius: 0.375em;">
									<label class="form-label">Password</label>
									<input wire:model.live="password" type="{{ $passwordType }}" id="password" class="form-control text-white">
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
									</div>
								@endif
								
								<div class="form-check form-check-info text-start ps-0 mt-3">
									<input class="form-check-input" type="checkbox" wire:model.live="is_verified"
										id="flexCheckDefault" checked>
									<label class="form-check-label" for="flexCheckDefault">
										I agree to <a target="_blank" href="{{ route('toc') }}" class="text-dark font-weight-normal"><span class="d-sm-none">MedSnapp's</span> Terms and Conditions</a>
									</label>
									<button type="{{ !$is_verified ? 'button' : 'submit' }}" class="btn btn-lg text-lg text-white bg-gradient-medsnapp {{ !$is_verified ? 'disabled' : '' }} text-capitalize w-100 py-2 mt-3 mb-0"
									data-sitekey="{{ config('app.recaptcha_site_key_v3') }}" data-callback="handle_recaptcha_v3" data-action="submit">
										Sign Up&nbsp;<span wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer text-center pt-0 px-lg-2 px-1">
							<p class="mb-2 text-sm mx-auto">
								Already have an account?
								<a href="{{ route('login') }}" class="text-light font-weight-bold">Sign In</a>
							</p>

							<div class="w-100 text-center text-sm my-4" style="border-bottom: thin solid gray; border-left:100px solid transparent; border-right:100px solid transparent;">
								<span class="bg-dark-brown position-absolute translate-middle px-3">OR</span>
							</div>

							<button type="button" wire:click="redirectToGoogle" class="google-btn mt-2 mb-2">
								<img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo">
								Sign up with Google
								<span wire:loading wire:target="redirectToGoogle" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
							</button>
						</div>
					</div>
				</div>
				<div class="col-lg-6 d-lg-block d-md-none d-sm-none px-xxl-6 bg-white">
					<div class="overflow-y-auto max-height-vh-90 my-auto mt-xxl-12 mt-lg-6 mt-0">
						@include('components.materials.senja-carousel')
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<script src="https://www.google.com/recaptcha/api.js?render={{ config('app.recaptcha_site_key_v3') }}"></script>

<script>
	function handle_recaptcha_v3(e) {
		grecaptcha.ready(function () {
			grecaptcha.execute("{{ config('app.recaptcha_site_key_v3') }}", {action: 'submit'})
				.then(function (token) {
					@this.set('captcha', token);
				});
		})
	}

	/*
	const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    togglePassword.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        togglePassword.classList.toggle('fa-eye-slash');
    });
	*/
</script>