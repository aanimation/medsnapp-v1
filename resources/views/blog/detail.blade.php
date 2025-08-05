@extends('components.layouts.blog')

@section('og')
<meta property="og:title" content="{{ $item->title }} | {{ $item->category->name }} | MedSnapp" />
<meta property="og:description" content="{!! $item->excerpt !!}" />
@endsection

@section('content')
	<main class="main-content mt-0">
		<div class="container-fluid px-2 px-md-4 bg-black">
			<div class="page-header page-header-bg min-height-300 border-radius-xl">
				<!-- <span class="mask bg-gradient-dark opacity-9"></span> -->
			</div>

			<div class="card card-body mx-3 mx-md-4 mt-n6">
				<div class="row gx-4">
					<div class="col-auto my-auto">
						<div class="h-100">
							<div class="d-flex align-items-center justify-content-between">
								<a href="{{ route($item->category->slug) }}" type="button" class="btn btn-outline-primary btn-sm mb-0">Back</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="row mt-3">
						<div class="col-12 position-relative">
							<div class="card card-plain h-100">
								<div class="card-header text-center pb-0 ps-lg-10 pe-lg-10">
									<h2 class="mb-0">{{ $item->title }}</h2>
									<p>{{ $item->author->name }} - {{ date("d/m/Y", strtotime($item->published_at)) }}</p>
								</div>
								<div class="card-body text-dark p-3">
									<h6 class="text-uppercase text-body text-xs">@foreach($item->tags as $tag)
										<span class="badge badge-success text-dark">{{ $tag->name }}</span>
									@endforeach
									</h6>
									{!! $item->content !!}
								</div>
							</div>
							<hr class="vertical dark">
						</div>

						{{--
						<div class="col-12 col-xl-3 mt-xl-0 mt-4">
							@include('blog.right', ['author' => $item->author, 'published_at' => $item->published_at])
						</div>
						--}}

					</div>
					@if(count($relates))
					<div class="row mt-4">
						<div class="col-12">
							@include('blog.bottom', ['relates' => $relates, 'category' => $item->category->name])
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</main>
@endsection