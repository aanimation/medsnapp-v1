<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2">
		<div class="row">
			<div class="col-12 mb-4">	
				<!-- table card -->
				<div class="card">
					<div class="card-header p-0 ps-3 pt-3">
						<div class="text-lg">My Questions</div>
					</div>
					<div class="card-body">
						@if($questions->count())
						<div class="table-responsive">
							<table class="table align-items-center mb-0">
								<thead>
									<tr>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created at</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Approved at</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($questions as $item)
									<tr>
										<td>
											<div class="d-flex px-2">
												<div class="my-auto">
													<div class="d-flex align-items-center text-white">{{ ucfirst($item->title) }}</div>
												</div>
											</div>
										</td>
										<td>
											<div class="d-flex px-2">
												<div class="my-auto">
													<div class="d-flex align-items-center">{{ $item->categoryName }}</div>
												</div>
											</div>
										</td>
										<td>
											<span class="text-xs text-uppercase">{{ $item->approved_at ? 'approved' : strtoupper($item->status) }}</span>
										</td>
										<td>
											<p class="text-xs font-weight-normal mb-0">{{ $item->created_at }}</p>
										</td>
										<td class="align-middle text-center">
											<div class="d-flex align-items-center">
												<span class="me-2 text-xs">{{ $item->approved_at ?? 'waiting' }}</span>
											</div>
										</td>
										<td class="align-middle text-end">
											{{--
											<a href="{{ route('question-detail', $item->skey) }}" class="badge bg-gradient-secondary cursor-pointer">
												<i class="material-symbols-outlined text-xs p-0">visibility</i>
											</a>
											--}}
											@if($item->approved_at)
											<div class="badge bg-gradient-secondary text-muted">
												<i class="material-symbols-outlined text-xs p-0">edit</i>
											</div>
											<div class="badge bg-gradient-secondary text-muted">
												<i class="material-symbols-outlined text-xs p-0">delete</i>
											</div>
											@else
											<div wire:click="doAction('{{$item->skey}}', 'edit')" class="badge bg-gradient-secondary cursor-pointer">
												<i class="material-symbols-outlined text-xs p-0">edit</i>
											</div>
											<div wire:click="doAction('{{$item->skey}}', 'delete')" class="badge bg-gradient-secondary cursor-pointer">
												<i class="material-symbols-outlined text-xs p-0">delete</i>
											</div>
											@endif
											
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@else
						<div class="text-center text-warning text-sm">No question found</div>
						@endif
					</div>
				</div>
				<!-- end table card -->
			</div>
		</div>

		<div class="row">
			<div class="col-12 mb-4">
				@livewire('question.question-form')
			</div>
		</div>

	</div> <!-- end container -->
</div>

<script>
	document.addEventListener('deleteConfirm', (event) => {
		Swal.fire({
			title: "Are you sure?",
			text: "You will lose 1 reputation.",
			imageUrl: "/assets/svg/ui/warning.svg",
			imageWidth: 60,
			imageHeight: 60,
			imageAlt: "warning",
			showCancelButton: false,
			showCloseButton: true,
			confirmButtonColor: "#8f4ce8",
			confirmButtonText: "Confirm delete"
		})
		.then((result) => {
			if (result.isConfirmed) {
				Livewire.dispatch('delete', {key: event.detail.key});
			}
		});
	});
</script>
