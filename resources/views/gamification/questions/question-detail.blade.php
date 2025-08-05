<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2">
		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header p-3">
						<a href="{{ route('question-user') }}" class="btn btn-sm bg-gradient-secondary">Back</a>
						<h5 class="mb-2">Detail</h5>
						<p class="mb-0">The details about stats, comments, and improves submitted.</p>
					</div>
					<div class="card-body p-3">
						<div class="row">
							<div class="col-3 text-center">
								<div class="border border-dark border-1 border-radius-md py-3">
									<h6 class="text-info text-gradient mb-0">Likes</h6>
									<h4 class="font-weight-bolder mb-0"><span class="small">0</span></h4>
								</div>
							</div>
							<div class="col-3 text-center">
								<div class="border border-dark border-1 border-radius-md py-3">
									<h6 class="text-danger text-gradient mb-0">Dislikes</h6>
									<h4 class="font-weight-bolder mb-0"><span class="small">0</span></h4>
								</div>
							</div>
							<div class="col-3 text-center">
								<div class="border border-dark border-1 border-radius-md py-3">
									<h6 class="text-success text-gradient mb-0">Favourites</h6>
									<h4 class="font-weight-bolder mb-0"><span class="small">0</span></h4>
								</div>
							</div>
							<div class="col-3 text-center">
								<div class="border border-dark border-1 border-radius-md py-3">
									<h6 class="text-success text-gradient mb-0">Save</h6>
									<h4 class="font-weight-bolder mb-0"><span class="small">0</span></h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="card h-100">
					<div class="card-header p-3">
						<h5 class="mb-2">Content</h5>
						<p class="mb-0">{!! $question->clinical_vignette !!}</p>
						<div class="mb-0"><span class="small text-info">22 correct</span><span class="small text-danger float-end">22 incorrect</span></div>
					</div>
					<div class="card-body p-3">
						<div class="row">
							@foreach($answers as $item)
							<div class="col-12 text-start">
								<div class="border border-dark border-1 border-radius-md p-2 m-1">
									<h6 class="mb-0">{{ $answerLabels[$loop->index].'. '.$item['text']}} <span class="text-md text-success ms-3 {{ $item['value'] ? '' : 'd-none' }}">Correct answer</span></h6>
									<div class="text-sm">{{ $item['note'] ?? '' }}</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 mt-4">
				<div class="card mb-4">
					<div class="card-header pb-0 p-3">
						<h6>Top Users</h6>
					</div>
					<div class="card-body px-0 pt-0 pb-2">
						<div class="table-responsive p-0">
							<table class="table align-items-center mb-0">
								<thead>
									<tr>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											User
										</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
											Like
										</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											Favorite
										</th>
										<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
											Comment
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="d-flex px-3 py-1">
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm">User X</h6>
													<p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success font-weight-bold">2024-07-11 04:00</span></p>
												</div>
											</div>
										</td>
										<td>
											<p class="text-sm font-weight-normal mb-0">Yes</p>
										</td>
										<td class="align-middle text-center text-sm">
											<p class="text-sm font-weight-normal mb-0">No</p>
										</td>
										<td class="align-middle text-end">
											<div class="d-flex px-3 py-1 justify-content-center align-items-center">
												<p class="text-sm font-weight-normal mb-0">Yes</p>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="d-flex px-3 py-1">
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm">User X</h6>
													<p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success font-weight-bold">2024-07-11 04:00</span></p>
												</div>
											</div>
										</td>
										<td>
											<p class="text-sm font-weight-normal mb-0">Yes</p>
										</td>
										<td class="align-middle text-center text-sm">
											<p class="text-sm font-weight-normal mb-0">No</p>
										</td>
										<td class="align-middle text-end">
											<div class="d-flex px-3 py-1 justify-content-center align-items-center">
												<p class="text-sm font-weight-normal mb-0">Yes</p>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="d-flex px-3 py-1">
												<div class="d-flex flex-column justify-content-center">
													<h6 class="mb-0 text-sm">User X</h6>
													<p class="text-sm font-weight-normal text-secondary mb-0"><span class="text-success font-weight-bold">2024-07-11 04:00</span></p>
												</div>
											</div>
										</td>
										<td>
											<p class="text-sm font-weight-normal mb-0">Yes</p>
										</td>
										<td class="align-middle text-center text-sm">
											<p class="text-sm font-weight-normal mb-0">No</p>
										</td>
										<td class="align-middle text-end">
											<div class="d-flex px-3 py-1 justify-content-center align-items-center">
												<p class="text-sm font-weight-normal mb-0">Yes</p>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>