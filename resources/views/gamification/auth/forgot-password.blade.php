<main class="main-content mt-0">
	<div class="page-header min-vh-100">
		<div class="container" style="margin-top:-10rem;">
			<div class="row">
				<div class="col-12 col-lg-4 col-md-6 mx-auto">
					<div class="text-center mb-4">
						<a href="{{ route('homepage') }}/?">
							<img width="200" height="auto" src="/assets/img/logos/medsnapp-svg.svg" class="img-responsive">
						</a>
					</div>
					<div class="card card-plain bg-dark-brown" style="background: #334559">
						<div class="card-header pb-2 text-center">
							<h4 class="font-weight-bolder">Request Reset Password</h4>
						</div>
						<div class="card-body pt-0">
							@if (Session::has('status'))
							<div class="alert alert-success alert-dismissible text-white" role="alert">
								<span class="text-sm">{{ Session::get('status') }}</span>
								<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							@elseif (Session::has('email'))
							<div class="alert alert-danger alert-dismissible text-white" role="alert">
								<span class="text-sm">{{ Session::get('email') }}</span>
								<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
									aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							@endif
							<form wire:submit.prevent="show">
								<div class="input-group input-group-outline mt-3 @if(strlen($email ?? '') > 0) is-filled @endif">
									<label class="form-label">Email</label>
									<input wire:model="email" type="email" class="form-control text-white"
										>
								</div>
								@error('email')
								<p class='text-danger inputerror'>{{ $message }} </p>
								@enderror
								<div class="text-center">
									<button type="submit" class="btn bg-gradient-medsnapp text-white w-100 my-4 mb-2">Submit</button>
								</div>
								<p class="mt-3 mb-0 text-sm text-center">
									<a href="{{ route('login') }}" class="text-light text-lg font-weight-bolder">Sign In</a>
								</p>
								<p class="mt-4 mb-0 text-sm text-center">
									Don't have an account? 
									<a href="{{ route('register') }}" class="text-light text-md font-weight-bold">Sign up</a>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>