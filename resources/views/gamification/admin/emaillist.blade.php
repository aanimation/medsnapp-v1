<div class="container-fluid px-2 px-md-4">
	<div class="page-header min-height-300 border-radius-xl mt-4"
		style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
		<span class="mask  bg-gradient-primary  opacity-6"></span>
	</div>
	<div class="card card-body mx-3 mx-md-4 mt-n6">
		<div class="row gx-4 mb-2">
			<table class="table-responsive">
				<thead>
					<tr>
						<td>#</td>
						<td>Email</td>
						<td>Status</td>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $idx => $item)
					<tr wire:key="">
						<td>{{ $idx + 1 }}</td>
						<td>{{ $item->email }}</td>
						<td>{{ $item->status }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>