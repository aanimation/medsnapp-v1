<div class="">
	<!-- Navbar -->
	<!-- End Navbar -->
	<div class="container-fluid pb-4">
		<div class="row">
			<div class="col-12">
				<div class="card my-4">
					<div class="card-header p-4 pb-0">
						<div class="d-flex align-items-center">
							<div class="w-70">
								<h6 class="text-white text-capitalize ps-3">Patient Scenario List</h6>
							</div>
							<div class="w-30 text-end">
								<a href="{{ route('patient-form') }}" class="btn btn-sm bg-gradient-dark shadow-none me-2">Create New Patient Scenario</a>
							</div>
						</div>
					</div>
					<div class="card-body px-0 pb-2">

						@include('gamification.admin.elements.paginate-search')

						<div class="table-responsive p-0">
							<table class="table align-items-center mb-0">
								<thead>
									<tr>
										<th class="text-secondary text-center text-xxs font-weight-bolder opacity-7">No.</th>
										<th>&nbsp;</th>
										{{--
										<th class="text-secondary text-xxs font-weight-bolder opacity-7">Trial</th>
										--}}
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
										{{--
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created By</th>
										--}}
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Create at</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $item)
									<tr>
										<td class="align-middle text-center text-sm">{{ $loop->iteration + $data->firstItem() - 1 }}.</td>
										<td>
											@if(auth()->user()->isAdmin)
											<div wire:click="destroy('{{$item->skey}}')" class="badge cursor-pointer text-muted" wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">
												<i class="material-icons">delete</i>
											</div>
											@endif
											<a href="{{ route('patient-form', $item->skey) }}" class="badge cursor-pointer">
												<i class="material-icons">edit</i>
											</a>
											<a href="{{ route('inventory-form', $item->skey) }}" class="badge cursor-pointer">
												<i class="material-icons">dashboard</i>
											</a>
										</td>
										{{--
										<td class="align-middle text-center text-sm">
											{{ $item->is_trial ? 'Trial' : '-' }}
										</td>
										--}}
										<td>
											<div class="d-flex py-1">
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm">{{ $item->name }}</h6>
													<p class="text-xs text-secondary mb-0">{{ $item->sex }}
													</p>
												</div>
											</div>
										</td>
										<td>
											<p class="text-xs font-weight-normal mb-0">{{ $item->title }}</p>
										</td>
										<td>
											<p class="text-xs font-weight-normal mb-0">{{ strtoupper($item->status) }}</p>
										</td>
										{{--
										<td class="align-middle text-center text-sm">
											<p class="text-xs font-weight-bold mb-0">{{ ucfirst($item->ApproveBy->username) }}</p>
											<p class="text-xs text-secondary mb-0">{{ $item->CreateBy->username }}</p>
										</td>
										--}}
										<td class="align-middle text-center">
											<span
												class="text-secondary text-xs font-weight-bold">{{ $item->created_at }}</span>
										</td>
										<td>
											[{{$loop->index + 1}}]
											@if($item->order > 0)
											<div wire:click.prevent="reorder('{{$item->skey}}', 'up')" class="badge cursor-pointer text-muted" title="pull">
												<i class="fas fa-arrow-up"></i>
											</div>
											@endif

											@if($item->order < (count($data) - 1))
											<div wire:click.prevent="reorder('{{$item->skey}}', 'down')" class="badge cursor-pointer text-muted {{$item->order == 0 ? 'ms-4' : ''}}" title="push">
												<i class="fas fa-arrow-down"></i>
											</div>
											@endif
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