<footer class="footer bg-black pt-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto text-center mb-4 mt-2">
				@include('blog.social')
			</div>
		</div>
		<div class="row">
			<div class="col-8 mx-auto text-center mt-1">
				<p class="mb-0 text-secondary">
					&copy; {{ config('app.name', 'MedSnapp') }} {{ date('Y') }}
				</p>
			</div>
		</div>
	</div>
</footer>