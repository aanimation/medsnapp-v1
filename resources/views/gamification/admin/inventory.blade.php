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
								<h6 class="text-white text-capitalize ps-3">Inventories List</h6>
							</div>
							<div class="w-30 text-end">
								<a href="#" class="btn btn-sm bg-gradient-dark shadow-none me-2">Create New Inventory</a>
							</div>
						</div>
					</div>
					<div class="card-body px-0 pb-2">

						@include('gamification.admin.elements.paginate-search')

						<div class="table-responsive p-0">
							<table class="table align-items-center mb-0">
								<thead>
									<tr>
										<th class="text-secondary text-center text-xxs opacity-7">No.</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											Name</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
											Category</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											Price</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											Created at</th>
										<th class="text-secondary opacity-7"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $item)
									<tr>
										<td class="align-middle text-center text-sm">{{ $loop->iteration + $data->firstItem() - 1 }}.</td>
										{{--
										<td>
											<a href="{{ route('inventory-form', $item->skey) }}" class="badge cursor-pointer">
												<i class="material-icons">edit</i>
											</a>
										</td>
										--}}
										<td>
											<div class="d-flex px-2 py-1">
												<div>
													<img src="{{ asset('assets') }}/svg/{{$item->type}}/{{$item->name}}.svg"
														class="avatar avatar-sm me-3 border-radius-lg"
														alt="user1">
												</div>
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm">{{ $item->name }}</h6>
													<p class="text-xs text-secondary mb-0">{{ $item->type }}
													</p>
												</div>
											</div>
										</td>
										<td>
											<p class="text-xs font-weight-normal mb-0">{{ $item->category }}</p>
											<p class="text-xs text-secondary mb-0">{{ $item->sub1 }}</p>
										</td>
										<td class="align-middle text-center text-sm">
											<span class="badge badge-sm bg-gradient-success">{{ $item->price }}</span>
										</td>
										<td class="align-middle text-center">
											<span
												class="text-secondary text-xs font-weight-bold">{{ $item->created_at }}</span>
										</td>
										<td class="align-middle">
											<div class="text-secondary font-weight-bold text-xs"
												data-toggle="tooltip" data-original-title="Edit user">
												{{ $item->damage }}
											</div>
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