<div class="">
	<!-- Navbar -->
	<!-- End Navbar -->
	<div class="container-fluid py-4">
		<div class="row">
			<div class="col-12">
				<div class="card mb-4">
					<div class="card-header p-2 pt-4 pb-0">
						<div class="d-flex">
							<div class="w-60">
								<h6 class="text-white text-capitalize ps-3">{{ $model->username }} Detail</h6>
							</div>
							<div class="w-40 text-end">
								<a href="{{ route('user-logs', $model->skey) }}" class="btn btn-sm bg-gradient-medsnapp text-white shadow-none px-4 me-2">View Logs</a>
								<a href="{{ route('user-list') }}" class="btn btn-sm bg-gradient-dark shadow-none me-2">Back to list</a> 
							</div>
						</div>
					</div>
					<div class="card-body px-4">
						<div class="text-md text-warning mb-4">{{ $model->Info ? '' : 'Profile not completed' }}</div>
						<div class="row">
							<div class="col-lg-4">
								<ul class="list-group">
									<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong>First name: </strong>{{ $model->Info ? $model->Info->firstname : 'not set' }}</li>
									<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong>Last name: </strong>{{ $model->Info ? $model->Info->lastname : 'not set' }}</li>
									<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong>Specialty: </strong>{{ $model->Info ? $model->Info->speciality : 'not set' }}</li>
									<li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong>Username: </strong>{{ $model->username }}</li>
								</ul>
							</div>
							<div class="col-lg-4">
								<ul class="list-group">
									<li class="list-group-item border-0 ps-0 text-sm"><strong>Email: </strong>{{ $model->email }}</li>
									<li class="list-group-item border-0 ps-0 text-sm"><strong>Profession: </strong> {{ $model->Info ? ($model->Info->student_type ?? $model->Info->other) : 'not set' }}</li>
									<li class="list-group-item border-0 ps-0 text-sm"><strong>Country: </strong> {{ $model->Info ? $model->Info->Country->name : 'not set' }}</li>
									<li class="list-group-item border-0 ps-0 text-sm"><strong>University: </strong> {{ $model->Info ? ($model->Info->University ? $model->Info->University->name : 'not set') : 'not set' }}</li>
								</ul>
							</div>
							<div class="col-lg-4">
								<ul class="list-group">
									<li class="list-group-item border-0 ps-0 text-sm"><strong>Level: </strong>{{ $model->level }}</li>
									<li class="list-group-item border-0 ps-0 text-sm"><strong>Rank: </strong> {{ $model->rank ?? '-' }}</li>
									<li class="list-group-item border-0 ps-0 text-sm"><strong>Reputation: </strong> {{ $model->reputation }}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card card-body p-2 px-4 mb-4 text-start">
					<p class="mb-0 p-1 text-capitalize"><span class="text-info text-bold">Energy</span> <span>{{ $model->Atts->health ?? 0 }}</span></p>
					<p class="mb-0 p-1 text-capitalize"><span class="text-warning text-bold">Coins</span> <span>{{ $model->Atts->coins ?? 0 }}</span></p>
				</div>
			</div>
			<div class="col-8">
				<div class="card card-body d-flex p-2 px-4 mb-4 text-start">
					<p class="mb-0 p-0 text-capitalize"><span class="text-bold">{{ $currentTier }}</span> | Subscribe at {{ $model->Subscribe->first()->start_date ?? $model->created_at }}</p>
					<div class="progress-wrapper">
						<div class="progress-warning">
							<div class="progress-percentage text-end">
								<span class="text-sm font-weight-normal">{{ $freeDay }} days</span>
							</div>
						</div>
						<div class="progress mb-2">
							<div class="progress-bar bg-warning" role="progressbar" style="width: <?= floor(($freeDay/$maxDays) * 100) ?>%;"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card card-body p-4">
					<div class="row">
						<div class="col-6">
							<label class="text-bold">Currency</label>
							<div class="input-group input-group-outline">
								<select wire:model="selectedSubject" class="form-control text-white">
									<option class="d-none text-white" value="">select one</option>
									<option class="text-white" value="coins">Coins</option>
									<option class="text-white" value="health">Energy</option>
								</select>
							</div>
						</div>
						<div class="col-6">
							<label class="text-bold">amount</label>
							<div class="input-group input-group-outline mb-3">
								<input wire:model="subjectAmount" type="number" class="form-control text-white">
							</div>
						</div>
					</div>
					<button type="button" wire:click.prevent="subventionUser" class="btn btn-sm bg-gradient-medsnapp mx-4 text-white mb-0">Submit <span wire:loading wire:target="subventionUser" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
				</div>
			</div>
			<div class="col-4">
				<div class="card card-body p-4">
					<label class="text-bold">Subscription</label>
					<div class="input-group input-group-outline">
						<select wire:model="selectedTierCode" class="form-control text-white">
							<option class="d-none text-white">select one</option>
							@foreach($subscriptions as $item)
							<option value="{{ $item->tier_code }}">{{ $item->tier_name }}</option>
							@endforeach
						</select>
					</div>
					<button type="button" wire:click="subscribeUser" class="btn btn-sm bg-gradient-medsnapp mx-4 text-white mt-3 mb-0">Apply <span wire:loading wire:target="subscribeUser" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
				</div>
			</div>
			<div class="col-4">
				<div class="card card-body h-100 d-flex px-0 pb-0">
					<button type="button" wire:click="resetUser" wire:confirm="Are you sure you want to RESET this user?" class="btn btn-md bg-gradient-info w-70 mx-auto">RESET</button>
					<button type="button" wire:click="resetUser(true)" wire:confirm.prompt="Are you sure you want to permanently delete this user?\nThis action cannot be reversed.\n\nType DELETE to confirm|DELETE" class="btn btn-sm bg-gradient-danger w-70 mx-auto">DELETE</button>
				</div>
			</div>
		</div>
	</div>
</div>