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
								<h6 class="text-white text-capitalize ps-3">Admins/Operator</h6>
							</div>
							<div class="w-40 text-end">
								&nbsp;	
							</div>
						</div>
					</div>
					<div class="card-body px-4 pb-2">
						@foreach($data as $item)
						<button wire:key="{{$loop->iteration}}" wire:click.prevent="editDetail('{{$item->skey}}')" class="btn btn-md btn-outline-white">
							<span>{{ $item->name }}</span>
						</button>
						@endforeach


						<hr class="horizontal light mt-0 mb-4">

						<div class="row">
							<div class="col-6">
								@if($currentEdit)
									<form wire:submit.prevent="submitDetail">
										<label class="form-label">Name</label>
										@error('name')
											<span class="ms-2 text-xs text-warning">{{ $message }}</span>
										@enderror
										<div class="input-group input-group-outline mb-3">
											<input wire:model="name" type="text" class="form-control text-white">
										</div>

										<label class="form-label">Email</label>
										@error('email')
											<span class="ms-2 text-xs text-warning">{{ $message }}</span>
										@enderror
										<div class="input-group input-group-outline mb-3">
											<input wire:model="email" type="text" class="form-control text-white">
										</div>

										<label class="form-label">New Password</label>
										@error('email')
											<span class="ms-2 text-xs text-warning">{{ $message }}</span>
										@enderror
										<div class="input-group input-group-outline mb-3">
											<input wire:model="newpassword" type="text" class="form-control text-white">
										</div>

										<button type="button" wire:click.prevent="closeForm" class="btn btn-sm">Cancel</button>
									 	<button type="submit" class="btn btn-sm bg-gradient-medsnapp text-white w-sm-100 mt-sm-4 float-end">Update<span wire:loading wire:target="submitDetail" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
									</form>
								@else
								<div class="alert alert-sm alert-dark alert-dismissible fade show text-white p-2 ps-4" role="alert">
									<span class="alert-text text-sm">Click one of operator button above to view or edit detail</span>
								</div>
								@endif
							</div>
							@if($currentEdit)
							<div class="col-4 me-4">
								<label class="form-label opacity-6">Name</label>
								<div class="input-group input-group-outline mb-3">
									<input value="{{$name}}" type="text" class="form-control text-secondary" disabled>
								</div>
								<label class="form-label opacity-6">Email</label>
								<div class="input-group input-group-outline mb-3">
									<input value="{{$email}}" type="text" class="form-control text-secondary" disabled>
								</div>
								<label class="form-label opacity-6">Current Password</label>
								<div class="input-group input-group-outline mb-3">
									<input type="password" value="{{$password}}" type="text" class="form-control text-secondary" disabled>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>