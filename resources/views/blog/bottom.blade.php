<div class="mb-5 ps-3">
	<h6 class="mb-1">More Posts</h6>
	{{-- <p class="text-sm">{{ $category }}</p> --}}
</div>
<div class="row">
	@foreach($relates as $relate)
	<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
		<div class="card card-blog card-plain">
			<div class="card-header p-0 mt-n4 mx-3">
				<a class="d-block shadow-xl border-radius-xl">
					<img class="img-thumbnail" width="300" height="auto" src="{{ $relate->banner ? Storage::url($relate->banner) : 'https://medsnapp.com/assets/img/logos/new-logo.png' }}">
				</a>
			</div>
			<div class="card-body p-3">
				<p class="mb-0 text-sm">{{ $relate->tags->first() }}</p>
				<a href="{{ route('post-detail', ['type' => $category ,'slug' => $relate->slug]) }}">
					<h5>{{ $relate->title }}</h5>
				</a>
				<p class="mb-4 text-sm">{{ Str::limit($relate->excerpt, 90, '...') }}</p>
				<div class="d-flex align-items-center justify-content-between">
					<a href="{{ route('post-detail', ['type' => $category ,'slug' => $relate->slug]) }}" type="button" class="btn btn-outline-primary btn-sm mb-0">View Post</a>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>