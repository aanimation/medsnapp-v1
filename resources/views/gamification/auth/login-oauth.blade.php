<main class="main-content mt-0">
	<section>
		<div class="container-fluid">
			<div class="row vh-100 gx-5">
				@if (session('status'))
		            <div class="mb-4 font-medium text-sm text-green-600">
		                {{ session('status') }}
		            </div>
		        @endif
				<h1>Google Callback</h1>
			</div>
		</div>
	</section>
</main>