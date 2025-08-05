<div class="">
	<!-- Navbar -->
	<!-- End Navbar -->
	<div class="container-fluid pb-4">
		<div class="row">
			<div class="col-12">
				<div class="card my-4">
					<div class="card-header pt-4 pb-0">
						<div class="d-flex align-items-center">
							<div class="w-70">
								<h6 class="text-white text-capitalize ps-3">Questions List</h6>
							</div>
							<div class="w-30 text-end">
								<a href="{{ route('question-form') }}" class="btn btn-sm bg-gradient-dark shadow-none me-2">Create New Question</a>
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
										<th>&nbsp;</th>
										<th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
											Search</th>
										<th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
											Topic</th>
										<th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
											Category</th>
										<th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">
											Status</th>
										<th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">
											Created at</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $item)
									<tr>
										<td class="align-middle text-center text-sm">{{ $loop->iteration + $data->firstItem() - 1 }}.</td>
										<td class="d-flex">
											@if(auth()->user()->isAdmin)
											<div wire:click="destroy('{{$item->skey}}')" class="badge cursor-pointer text-muted" wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE">
												<i class="material-icons">delete</i>
											</div>
											@endif
											<a href="{{ route('question-form', $item->skey) }}" class="badge cursor-pointer">
												<i class="material-icons">edit</i>
											</a>
											<div title="preview" wire:click="doAction('{{ $item->skey }}')" class="badge cursor-pointer"><i class="material-icons">dashboard</i></div>
										</td>
										<td>
											<p class="text-xs font-weight-normal mb-0">{{ $item->description }}</p>
										</td>
										<td>
											<p class="text-xs font-weight-normal mb-0">{{ $item->topic }}</p>
										</td>
										<td>
											<h6 class="mb-0 text-sm">{{ $item->categoryName }}</h6>
										</td>
										<td class="align-middle text-center text-sm">
											<span class="badge badge-sm bg-gradient-{{$item->status === 'draft' ? 'secondary' : 'success'}}">{{ $item->status }}</span>
										</td>
										<td class="align-middle text-center">
											<span
												class="text-secondary text-xs font-weight-bold">{{ $item->created_at }}</span>
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
		@livewire('admin.question-modal')
	</div>
</div>

<script type="text/javascript">
	window.addEventListener('previewModalEvent', event => {
		$('#modal-preview').modal(event.detail.show ? 'show' : 'hide');
	})
</script>