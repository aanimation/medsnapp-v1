@extends('components.layouts.blog')

@section('content')
	<main class="main-content main-content-bg mt-0 min-vh-65">
		<div class="page-header align-items-start">
			<div class="container mt-12">
				<!-- Content -->
				<div class="row mt-lg-4 mt-2 ms-lg-6 me-lg-6">
					@foreach($items as $item)
					<div class="col-lg-4 col-md-6 mb-4 mt-2">
						<div class="card">
							<div class="card-body p-3">
								<div class="d-flex mt-n2">
									<div class="avatar avatar-xl bg-gradient-dark border-radius-xl p-1 mt-n4">
										@if($item->banner)
										<img class="img-fluid" src="{{ Storage::url($item->banner) }}" alt="{{ $item->slug }}">
										@endif
									</div>
									<div class="ms-3 my-auto">
										<a href="{{ route('post-detail', ['type' => $item->category->slug, 'slug' => $item->slug])}}">
											<h6 class="mb-0">{{ strtoupper($item->title) }}</h6>
										</a>
									</div>
								</div>
								<p class="text-dark mt-3">{{ Str::limit($item->excerpt, 100, '...') }}</p>
								<hr class="horizontal dark">
								<div class="row justify-content-center">
									<div class="col-12">
										<a class="text-sm mb-0 icon-move-right mt-4" href="{{ route('post-detail', ['type' => $item->category->slug, 'slug' => $item->slug]) }}">
											Read More
											<i class="material-icons text-sm ms-1 position-relative" aria-hidden="true">arrow_forward</i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<!-- End Content -->

			</div>
		</div>
	</main>
@endsection