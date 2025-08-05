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
								<h6 class="text-white text-capitalize ps-3">Transactions</h6>
							</div>
							<div class="w-40 text-end">
								<div class="form-check">
									<input id="show-all" class="form-check-input" type="checkbox" wire:model.live="showAll" @if($showAll)checked @endif>
									<label class="custom-control-label text-bold pe-3" for="show-all">Show All</label>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body px-0 pb-2">

						@include('gamification.admin.elements.paginate-search')

						<div class="table-responsive p-0">
							<table class="table align-items-center mb-0">
								<thead>
									<tr>
										<th class="text-uppercase text-center text-secondary text-xxs opacity-7">No.</th>
										<th class="text-uppercase text-secondary text-xxs opacity-7">Datetime</th>
										<th class="text-uppercase text-secondary text-xxs opacity-7">User</th>
										<th class="text-uppercase text-secondary text-xxs opacity-7 ps-2">Amount</th>
										<th class="text-uppercase text-secondary text-xxs opacity-7 ps-2 text-end">Qty</th>
										<th class="text-uppercase text-secondary text-xxs opacity-7 ps-2 text-start">Subject</th>
										<th class="text-center text-uppercase text-secondary text-xxs opacity-7 text-center">Status</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Paid at</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $item)
									<tr>
										<td class="align-middle text-center text-sm">
											{{ $loop->iteration + $data->firstItem() - 1 }}.
										</td>
										<td>
											<h6 class="mb-0 text-sm">{{ $item->trans_datetime }}</h6>
										</td>
										<td>
											<p class="text-xs font-weight-normal mb-0">{{ $item->user->name }}</p>
											<p class="text-xs text-secondary mb-0">{{ $item->user->email }}</p>
										</td>
										<td class="align-middle text-start text-sm">
											<span class="badge badge-sm bg-info text-dark p-2 {{ $item->payment_amount ? '' : 'd-none'}}">£ {{ $item->payment_amount }}</span>
										</td>
										<td class="align-middle text-center text-sm">
											{{ $item->quantity }}
										</td>
										<td class="align-middle text-start text-sm">
											{{ $item->subject }}
										</td>
										<td class="align-middle text-center text-sm">
											{{ $item->status }}
										</td>
										<td class="align-middle text-center">
											<span
												class="text-secondary text-xs font-weight-bold">{{ $item->paid_at }}</span>
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