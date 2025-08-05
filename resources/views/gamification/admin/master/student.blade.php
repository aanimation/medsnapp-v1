<div class="">
	<!-- Navbar -->
	<!-- End Navbar -->
	<div class="container-fluid pb-4">
		<div class="row">
			<div class="col-12">
				<div class="card my-4">
					<div class="card-header p-4 pb-0">
						<div class="d-flex">
							<div class="w-60">
								<h6 class="text-white text-capitalize ps-3">Student Profession</h6>
							</div>
							<div class="w-40 text-end">
								&nbsp;	
							</div>
						</div>
					</div>
					<div class="card-body px-4 pb-2">
						@foreach($data as $item)
							<span class="badge badge-pill bg-gradient-info p-3 mb-3 mx-2">{{ $item }}</span>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>