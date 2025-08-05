<div class="container my-auto">
	<div class="row">
		<div class="col-lg-4 col-md-8 col-12 mx-auto">
			<div class="card z-index-0 fadeIn3 fadeInBottom">
				<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
					<div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
						<h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Verify email</h4>
					</div>
				</div>
				<div class="card-body">
					<p>Please check your inbox, verification link has been sent</p>

					<a target="_blank" href="{{ route('verification.send') }}" class="btn btn-sm bg-gradient-primary">Re-send link</a>

					@if (Session::has('message'))
                    <div class="alert alert-info alert-dismissible text-white" role="alert">
                        <span class="text-sm">{{ Session::get('message') }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
				</div>
			</div>
		</div>
	</div>
</div>