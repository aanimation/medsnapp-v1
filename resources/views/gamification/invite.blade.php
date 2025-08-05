<div class="min-vh-80">
	<div class="container-fluid py-2 px-sm-2 px-xl-4 px-xxl-12">

		<div class="row justify-content-center mb-4">
			<div class="col-lg-6 col-12 mx-auto mb-4">
				<div class="card card-body with-border py-3 h-100">
					<h5 class="font-weight-normal">Invite</h5>
					<form wire:submit.prevent="sendInvitation">
						<div class="row gx-2 gx-sm-3 mt-3 mb-sm-0 mb-3">
							<div class="input-group mb-3">
								<input wire:model.live="email" type="text" placeholder="email" class="form-control is-{{ $errors->has('email') ? 'in' : '' }}valid" style="color: white!important;" />
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="btn bg-gradient-medsnapp text-white w-sm-50 w-lg-50 w-xl-30">Send invitation<span wire:loading wire:target="sendInvitation" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
						</div>
						@error('email')
							<span class="text-xs text-warning">{{ $message }}</span>
						@enderror
					</form>
				</div>
			</div>
			<div class="col-lg-6 col-12 mx-auto mb-4">
				<div class="card card-body with-border h-100">
					<h5 class="font-weight-normal">Referral</h5>
					<div class="row gx-2 gx-sm-3 mt-3 mb-1">
						<div class="mb-sm-0 mb-3 text-center">
							<p style="color: white!important; border: thin solid #747476;border-radius: 5px; padding: 6px;">{{$appUrl}}?ref={{$refCode}}</p>
						</div>
					</div>
					<div class="text-center">
						<button wire:click="copyToClipboard" class="btn bg-gradient-medsnapp text-white w-sm-40 w-lg-50 w-xl-30  {{ $isCopied ? 'disabled' : '' }}">Copy Link<span wire:loading wire:target="copyToClipboard" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-12">
				<div class="card card-body with-border h-100 py-3">
					<h5 class="font-weight-normal">Rewards</h5>

					<!-- Mobile -->
					<div class="row d-md-none">
						<div class="col-lg-6 col-12 mx-auto">
							<ul class="list-group">
								@for($i=1; $i <= ($status == 'down' ? 2 : 10 ); $i++)
								<li class="list-group-item d-flex justify-content-between align-items-center py-sm-0 py-md-0">
								{{ $i }} invite{{ $i > 1 ? 's' : '' }}
									<span class="badge fs-6 badge-primary badge-pill">{{ $i*5 }} <img width="20" height="20" src="/assets/svg/ui/coin.svg"/></span>
								</li>
								@endfor
							</ul>
							<button wire:click="setStatus('{{ $status }}')" class="btn btn-sm btn-link w-100 text-white text-capitalize opacity-7 font-weight-normal mt-4 mb-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReward" aria-expanded="false" aria-controls="collapseReward">{{ $status === 'down' ? 'More' : 'Hide'}}
								<i class="fa fa-chevron-{{ $status }} me-2"></i>
							</button>
						</div>
					</div>
					<!-- End Mobile -->

					<div class="row d-sm-none">
						<div class="col-lg-6 col-12 mx-auto">
							<ul class="list-group">
								@for($i=1; $i <= 5; $i++)
								<li class="list-group-item d-flex justify-content-between align-items-center">
								{{ $i }} invite{{ $i > 1 ? 's' : '' }}
									<span class="badge fs-6 badge-primary badge-pill">{{ $i*5 }} <img width="20" height="20" src="/assets/svg/ui/coin.svg"/></span>
								</li>
								@endfor
							</ul>
						</div>
						<div class="col-lg-6 col-12 mx-auto">
							<ul class="list-group">
								@for($i=6; $i <= 10; $i++)
								<li class="list-group-item d-flex justify-content-between align-items-center">
								{{ $i }} invites
									<span class="badge fs-6 badge-primary badge-pill">{{ $i*5 }} <img width="20" height="20" src="/assets/svg/ui/coin.svg"/></span>
								</li>
								@endfor
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-12 mt-sm-4">
				<div class="card card-body with-border h-100 mb-2">
					<h5 class="font-weight-normal ps-1">Referred Users</h5>
					<div class="table-responsive p-0">
						<table class="table align-items-center mb-0">
							<thead>
								<tr>
									<th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Email
									</th>
									<th class="text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
										Date
									</th>
									<th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">
										Status
									</th>
									<th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">
										Coins Earned
									</th>
									<th class="text-center text-secondary text-xxs font-weight-bolder opacity-7">
										Invite
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $item)
								<tr>
									<td>
										<p class="text-sm font-weight-normal mb-0">{{ $item->email }}</p>
									</td>
									<td>
										<p class="text-sm font-weight-normal mb-0">{{ date("Y-m-d", strtotime($item->created_at)) }}</p>
									</td>
									<td class="align-middle text-center text-sm">
										<p class="text-sm font-weight-normal mb-0">{{ strtoupper($item->status) }}</p>
									</td>
									<td class="align-middle text-center text-sm">
										<p class="text-sm font-weight-normal mb-0">{{ $item->coins > 0 ? $item->coins.' coins' : '' }}</p>
									</td>
									<td class="align-middle text-end">
										@if($item->from == 'referral')
										<div class="d-flex px-3 py-1 justify-content-center align-items-center">
											Referral
										</div>
										@else
										<div @if($item->status == 'accepted')title="{{$item->response}}" @endif class="d-flex px-3 py-1 justify-content-center align-items-center">
											<button wire:click="resendInvitation({{ $item->id }})" class="btn btn-sm bg-gradient-dark text-xs m-0 {{ $item->status != 'pending' ? 'disabled' : '' }}">{{ $item->status != 'pending' ? 'Info' : 'Resend' }}</button>
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

		<div class="row">
			<!-- Referred users by referral -->
			<div class="col-12 d-none">
				<div class="card">
					<div class="card-header pb-0 p-3">
						<h6>Referred Users</h6>
					</div>
					<div class="card-body px-0 pt-0 pb-2">
						<div class="table-responsive p-0">
							<table class="table align-items-center mb-0">
								<thead>
									<tr>
										<th>&nbsp;</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											Username
										</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
											Email
										</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
											Register Date
										</th>
									</tr>
								</thead>

								<tbody>
									@foreach($referredUsers as $item)
									<tr>
										<td>
											<div class="d-flex px-3 py-1">
												<div>
													<i class="fas fa-user-circle text-success"></i>
												</div>
											</div>
										</td>
										<td>
											<p class="text-sm font-weight-normal mb-0">{{ $item->username }}</p>
										</td>
										<td>
											<p class="text-sm font-weight-normal mb-0">{{ $item->email }}</p>
										</td>
										<td>
											<p class="text-sm font-weight-normal mb-0">{{ date("Y-m-d", strtotime($item->created_at)) }}</p>
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

<script>
    document.addEventListener('copyToClipboard', (event) => {
        navigator.clipboard.writeText(event.detail.url)
        Swal.fire({
			icon: "success",
			text: "Link copied",
			timer: 2000,
            position: 'top-end',
			showConfirmButton: false,
		});
    });
</script>