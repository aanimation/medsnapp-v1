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
						<div class="card-header mb-0 pb-0">
							<h4 class="font-weight-bolder">Sign In</h4>
						</div>
						<div class="card-body py-2">
							<form wire:submit.prevent='store'>
								@if (Session::has('status'))
								<div class="alert alert-info alert-dismissible bg-gradient-dark text-white" role="alert">
									<span class="text-sm">{{ Session::get('status') }}</span>
									<button type="button" class="btn-close text-lg py-3 opacity-10"
										data-bs-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								@endif
								<div class="input-group input-group-outline mt-3 @if(strlen($email ?? '') > 0) is-filled @endif">
									<label class="form-label text-white">Email</label>
									<input wire:model='email' type="email" class="form-control text-white">
								</div>
								@error('email')
								<p class='text-xs mt-1 mb-0'>{{ $message }} </p>
								@enderror

								<div class="input-group input-group-outline mt-3 @if(strlen($password ?? '') > 0) is-filled @endif" style="border-radius: 0.375em;">
									<label class="form-label text-white">Password</label>
									<input wire:model="password" type="{{$passwordType}}" id="password" class="form-control text-white">
									<span wire:click.prevent="togglePasswordType" class="input-group-text cursor-pointer me-3" style="z-index: 99;"><i id="togglePassword" class="fa fa-eye{{$passwordType === 'text'? '-slash' : ''}}"></i></span>
								</div>
								@error('password')
								<p class='text-xs mt-1 mb-0'>{{ $message }} </p>
								@enderror

								<div class="d-flex">
									<div class="w-50 form-check align-items-center my-3 p-0">
										<input class="form-check-input" type="checkbox" id="rememberMe">
										<label class="form-check-label mb-0 ms-1 text-light" for="rememberMe">Remember me</label>
									</div>
									<div class="w-50 text-end my-3">
										<a href="{{ route('password.forgot') }}" class="form-check-label opacity-8 text-light">Forgot Password?</a>
									</div>
								</div>
								
								<div class="text-center">
									<button type="submit" class="btn btn-lg text-white text-lg font-weight-normal text-capitalize bg-gradient-medsnapp w-100 py-2 my-2"
										data-sitekey="{{ config('app.recaptcha_site_key_v3') }}"
										data-callback="handle_recaptcha_v3"
										data-action="submit">
										Continue&nbsp;<span wire:loading wire:target="store" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									</button>

									<p class="my-3 mb-4 text-sm text-center">
										Don't have an account? <a href="{{ route('register') }}" class="ps-1 text-bold">Sign Up</a>
									</p>

									<div class="w-100 text-center text-sm my-4" style="border-bottom: thin solid gray; border-left:100px solid transparent; border-right:100px solid transparent;">
  										<span class="bg-dark-brown position-absolute translate-middle px-3">OR</span>
									</div>

									<button type="button" wire:click="redirectToGoogle" class="google-btn mt-2 mb-4">
										<img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo">
										Continue with Google
										<span wire:loading wire:target="redirectToGoogle" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-6 d-lg-block d-md-none d-sm-none px-xxl-auto bg-white">
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