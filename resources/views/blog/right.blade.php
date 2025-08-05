<div class="card card-plain h-100">
	<div class="card-header pb-0 p-3">
		<div class="mb-0">Author</div>
	</div>
	<div class="card-body p-3">
		<ul class="list-group">
			<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
				{{--
				<div class="avatar me-3">
					<img src="{{ Storage::url($author->photo) }}" alt="author" class="rounded-circle shadow">
				</div>
				--}}
				<div class="d-flex align-items-start flex-column justify-content-center">
					<h6 class="mb-0 text-sm">{{ $author->name }}</h6>
					{{-- $author->bio --}}
				</div>
				{{--
				<a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="">Contact</a>
				--}}
			</li>
			<li class="list-group-item border-0 d-flex align-items-center px-0 mt-2 pt-0">
				<div class="d-flex align-items-start flex-column justify-content-center">
					<div class="mb-0 text-sm">Published at {{ date("d M Y", strtotime($published_at)) }}</div>
				</div>
			</li>
		</ul>
	</div>
</div>