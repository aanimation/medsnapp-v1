<div class="container-fluid py-2 px-sm-2 px-xl-4 px-xxl-12">
	<div class="row mb-5">
		<div class="col-lg-12 mt-lg-0 mt-4">
			<div class="card card-body with-border">
				<div class="row {{session()->has('next-route-num') ? 'd-none' : ''}}">
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

			<form id="profileForm" wire:submit.prevent="updateProfile">
			<div class="row">
				<!-- User Settings -->
				<div class="col-12 col-lg-6 mt-lg-0">
					<div class="card card-body with-border p-3 pb-4 mt-4 h-100 min-vh-35">
						<h5 class="font-weight-normal">User Settings</h5>
						<div class="row my-4">
							<div class="col-lg-6">
								<label class="form-label">Username</label>
								<div class="input-group input-group-outline">
									<input wire:model.blur="username" type="text" class="form-control text-white @error('username')is-invalid @enderror"/>
								</div>
								@error('username')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
							</div>
							<div class="col-lg-6 mt-sm-4">
								<label class="form-label">Email</label>
								<div class="input-group input-group-outline">
									<input type="email" value="{{ $email }}" class="form-control text-white opacity-5 disabled" disabled />
								</div>
							</div>
						</div>

						<div class="row mb-4">
							<div class="col-lg-6">
								<label class="form-label">First Name</label>
								<div class="input-group input-group-outline">
									<input wire:model.blur="firstname" type="text" class="form-control text-white" 
									/>
								</div>
								@error('firstname')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
							</div>
							<div class="col-lg-6 mt-sm-4">
								<label class="form-label">Surname</label>
								<div class="input-group input-group-outline">
									<input wire:model.blur="surname" type="text" class="form-control text-white" />
								</div>
								@error('surname')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="row mb-4">
							<div class="col-lg-6">
								@foreach($types as $typ)
								<div class="input-group input-group-outline">
									<div class="form-check ps-0">
										<input wire:model.live="type" class="form-check-input ps-0" type="radio" value="{{ $typ }}" id="radio{{ str_replace(' ', '-', $typ) }}" @if($typ == $type) checked @endif>
										<label class="custom-control-label" for="radio{{ str_replace(' ', '-', $typ) }}">{{ ucfirst($typ) }}</label>
									</div>
								</div>
								@endforeach
								
							</div>

							<div class="col-lg-6 mt-sm-4">
								@if($type == $types[0]) <!-- student -->
								<label class="form-label">Subject</label>
								<div wire:key="{{$types[0]}}" class="input-group input-group-outline">
									<select wire:model="student_type" class="form-control text-white">
										<option class="d-none" value="">Select</option>
										@foreach($students as $stu)
										<option value="{{ $stu }}" @if($stu == $student_type) selected @endif>{{ $stu }}</option>
										@endforeach
									</select>
								</div>
								@error('student_type')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
								@endif

								@if($type == $types[1]) <!-- professional -->
								<label class="form-label">Profession</label>
								<div wire:key="{{$types[1]}}" class="input-group input-group-outline">
									<select wire:model="profession" class="form-control text-white">
										<option value="">Select</option>
										@foreach($professions as $pro)
										<option value="{{ $pro }}" @if($pro == $profession) selected @endif>{{ $pro }}</option>
										@endforeach
									</select>
								</div>
								@error('profession')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
								@endif

								@if($type == $types[2]) <!-- other -->
								<label class="form-label">Other</label>
								<div wire:key="{{$types[2]}}" class="input-group input-group-outline">
									<input wire:model="other" type="text" class="form-control text-white" placeholder="ex. lecture" />
								</div>
								@error('other')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
								@endif

							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<label class="form-label">Country</label>
								<div class="input-group input-group-outline">
									<select wire:model.live="country" class="form-control text-white">
										<option class="d-none" value="">Select</option>
										@foreach($countries as $cnt)
										<option value="{{ $cnt->id }}" @if($cnt->id == $country) selected @endif>{{ $cnt->name }}</option>
										@endforeach
									</select>
								</div>
								@error('country')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
							</div>

							@if($type == $types[0])
							<div class="col-lg-6 mt-sm-4">
								<label class="form-label">University</label>
								<div class="input-group input-group-outline">
									<select wire:model="university" class="form-control text-white">
										<option class="d-none" value="">Select</option>
										@foreach($universities as $unv)
											<option value="{{ $unv->id }}" @if($unv->id == $university) selected @endif>{{ $unv->name }}</option>
										@endforeach
									</select>
								</div>
								@error('university')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
							</div>
							@endif
						</div>
					</div>
				</div>
				<!-- end User Settings -->

				<!-- Game Settings -->
				<div class="col-12 col-lg-6 mt-lg-0 mt-sm-4">
					<div class="card card-body with-border p-3 pb-4 mt-4 h-100 min-vh-35">
						<h5 class="font-weight-normal">Game Settings</h5>
						<div class="row my-4">
							<div class="col-lg-6">
								<label class="form-label">Speciality</label>
								<div class="input-group input-group-outline">
									<select wire:model="speciality" class="form-control text-white">
										<option class="d-none" value="">Select</option>
										@foreach($specialities as $spec)
										<option value="{{ $spec }}" @if($spec == $speciality) selected @endif>{{ $spec }}</option>
										@endforeach
									</select>
								</div>
								@error('speciality')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
							</div>
							<div class="col-lg-6 d-sm-none">
								<p class="font-weight-normal text-decoration-underline ms-3 mt-4">Dr. {{ $surname }}</p>
							</div>
						</div>
						<div class="row justify-content-center">
							@if(session()->has('profile-saved'))
							<div class="col-12">
								<div class="alert alert-info bg-gradient-dark alert-dismissible fade show text-white mt-4" role="alert">
									<span class="alert-text">{!! session()->get('profile-saved') !!}</span>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
							@endif
						</div>

						<button type="submit" class="btn btn-sm bg-gradient-medsnapp position-absolute bottom-4 end-3 text-white font-weight-bolder mt-3 mb-0 mx-auto"><span wire:loading.remove wire:target="updateProfile">Save Changes</span><span wire:loading wire:target="updateProfile" class="spinner-border spinner-border-sm mx-4" role="status" aria-hidden="true"></span></button>
					</div>
				</div>
				<!-- end Game Settings -->
			</div>

			</form>
		</div>
	</div>
</div>

@include('components.materials.firebase')

<script>
	document.addEventListener('completedProfileAlert', (event) => {
		Swal.fire({
			title: "Congratulations",
			text: "You have completed your profile and gained 10 exp!",
			showCancelButton: false,
			showCloseButton: false,
			allowOutsideClick: false,
			confirmButtonColor: "#8f4ce8",
			confirmButtonText: "Next"
		})
		.then((result) => {
			if (result.isConfirmed) {
				Livewire.dispatch('setNextBoard');
			}
		});
	});
</script>
