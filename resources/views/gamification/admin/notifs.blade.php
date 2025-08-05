<div class="">
	<div class="container-fluid py-4">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header p-0 position-relative mx-3 z-index-2">	
						<h6 class="text-white text-capitalize mt-4 ps-3">In-App Notifications</h6>
					</div>
					<div class="card-body px-0 pb-2">

						{{--
						<div class="row px-4">
							<div class="col-6">
								<div class="input-group input-group-outline">
									<label for="targetSelect" class="ms-0 me-2">Target Broadcasts</label>
									<select wire:model="target" multiple="" class="form-control pb-4" id="targetSelect">
										<option value="all">-- All --</option>
										@foreach($users as $user)
											<option value="{{ $user->web_token }}">{{ $user->name }}</option>
										@endforeach
									</select>
								</div>
								@error('target')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
							</div>
						</div>
						--}}
					</div>
				</div>
			</div>
		</div>

		<form wire:submit.prevent="sendMessage">
		<div class="row">
			<div class="col-6">
				<div class="card my-4">
					<div class="card-body px-4">
						<div class="row">
							<div class="col-12">
								<label class="form-label">Title*</label>
								@error('title')
									<span class="text-xs text-warning">{{ $message }}</span>
								@enderror
								<div class="input-group input-group-outline mb-3">
									<textarea wire:model="title" rows="1" class="form-control"></textarea>
								</div>
							</div>
							<div class="col-12">
								<label class="form-label">Message*</label>
								@error('description')
									<span class="text-xs text-warning">{{ $description }}</span>
								@enderror
								<div class="input-group input-group-outline mb-3">
									<textarea wire:model="description" rows="3" class="form-control"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="card my-4">
					<div class="card-body px-4">
							<div class="row">
								<div class="col-12 text-end">
									<button type="submit" class="btn btn-sm btn-info w-30">Send</button>
								</div>
							</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card my-4">
					<div class="card-body px-0 pb-2">

						<div class="table-responsive p-0">
							<table class="table table-striped table-hover align-items-center mb-0">
								<thead>
									<tr class="text-xs">
										<td>#</td>
										<td>Title</td>
										<td>Message</td>
										<td>Type</td>
									</tr>
								</thead>
								<tbody>
									@foreach($history as $item)
									<tr wire:key="{{ $loop->iteration }}">
										<td>{{ $loop->iteration + 1 }}</td>
										<td>{{ $item->title }}</td>
										<td><span title="{{$item->message}}">{{ Str::limit($item->description, 30) }}</span></td>
										<td>{{ $item->type }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>

	</div>
</div>