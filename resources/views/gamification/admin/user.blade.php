<div class="">
	<div class="container-fluid pb-4">
		<div class="row">
			<div class="col-12">
				<div class="card my-4">
					<div class="card-header p-4 pb-0">
						<div class="d-flex">
							<div class="w-60">
								<h6 class="text-white text-capitalize ps-3">User List</h6>
							</div>
							<div class="w-40 text-end">
								&nbsp;	
							</div>
						</div>
					</div>
					<div class="card-body px-0 pb-2">

						@include('gamification.admin.elements.paginate-search')

						<div class="table-responsive p-0">
							<table class="table table-striped table-hover align-items-center mb-0">
								<thead>
									<tr>
										<th class="text-muted text-xxs font-weight-bolder opacity-7">No.</th>
										<th></th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Username</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Level</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Verified At</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $item)
									<tr wire:key="{{ $loop->index }}" class="cursor-pointer">
										<td class="align-middle text-center text-sm">{{ $loop->iteration + $data->firstItem() - 1 }}.</td>
										<td class="align-middle">
											<div class="progress-wrapper w-75 mx-auto">
												<div class="progress-info">
													<div class="progress-percentage">
														<span class="text-xs font-weight-bold">{{ $item->left_days }}</span>
													</div>
												</div>
												<div class="progress">
													<div class="progress-bar bg-gradient-info" role="progressbar" style="width:<?= floor(($item->left_days/$item->max_days) * 100) ?>%;"></div> 
												</div>
											</div>
										</td>
										<td>
											<div class="d-flex px-2 py-1">
												<div class="d-flex flex-column justify-content-center">
													<h6 wire:click.prevent="openDetail('{{ $item->skey }}')" class="mb-0 text-sm cursor-pointer">{{ $item->name }}</h6>
												</div>
											</div>
										</td>
										<td>
											<p class="text-xs font-weight-normal mb-0">{{ $item->username }}</p>
											<p class="text-xs text-secondary mb-0">Reputation:{{ $item->reputation }}</p>
										</td>
										<td class="align-middle text-center text-sm">
											<p class="text-xs font-weight-bold mb-0">{{ $item->level }}</p>
											<p class="text-xs text-secondary mb-0">{{ $item->rank }}</p>
										</td>
										<td class="align-middle text-center">
											<p class="text-xs font-weight-normal mb-0">{{ $item->email }}</p>
											<span class="text-xs">{{ $item->google_id ? 'SSO Google' : '' }}</span>
										</td>
										<td class="align-middle text-center">
											@if($item->verify_code && is_null($item->google_id))
												<button wire:click.prevent="reminder({{$item->id}})" class="btn btn-sm bg-gradient-dark text-white mt-2 mb-0">Send Reminder</button>
											@else
											<span class="text-xs">{{ date("D d, M Y H:i a", strtotime($item->created_at)) }}</span>
											@endif
										</td>
										<td>
											<button wire:click="unlock({{$item->id}})" class="btn btn-sm {{ $item->is_locked ? 'bg-light text-dark' : 'bg-dark text-info' }} m-0">{{ $item->is_locked ? 'UNLOCK' : 'LOCK'}}</button>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>