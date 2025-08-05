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
								<h6 class="text-white text-capitalize ps-3">Posts List</h6>
							</div>
							<div class="w-30 text-end">
								<a href="{{ route('user-form') }}" class="btn btn-sm bg-gradient-dark shadow-none me-2">Create New Post</a> 
							</div>
						</div>
					</div>
					<div class="card-body px-0 pb-2">

						@include('gamification.admin.elements.paginate-search')

						<div class="table-responsive p-0">
							<table class="table table-striped table-hover align-items-center mb-0">
								<thead>
									<tr>
										<th class="text-secondary text-center text-xxs opacity-7">No.</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Updated</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $item)
									<tr wire:key="{{ $loop->index }}" class="cursor-pointer" wire:click.prevent="getPostForm('{{$item->slug}}')">
										<td class="align-middle text-center text-sm">{{ $loop->iteration + $data->firstItem() - 1 }}.</td>
										<td>
											<div class="d-flex px-2 py-1">
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm">{{ $item->title }}</h6>
													<p class="text-xs text-secondary mb-0">{{ Str::limit($item->excerpt, 15) }}
													</p>
												</div>
											</div>
										</td>
										<td>
											<p class="text-xs font-weight-normal mb-0">{{ $item->author->name }}</p>
											<p class="text-xs text-secondary mb-0">{{ $item->author->github_handle }}</p>
										</td>
										<td class="align-middle text-center text-sm">
											<p class="text-xs font-weight-bold mb-0">{{ $item->category->name }}</p>
										</td>
										<td class="align-middle text-center">
											<p class="text-xs font-weight-normal mb-0">{{ $item->created_at }}</p>
										</td>
										<td class="align-middle text-center">
											<p class="text-xs font-weight-normal mb-0">{{ $item->updated_at }}</p>
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