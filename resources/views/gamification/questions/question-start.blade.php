<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2 px-sm-2 px-xl-4 px-xxl-12">

		<div class="col-12 mb-4">
			<div class="card card-body with-border p-3">
				<h5 class="font-weight-normal mb-4">Question Sessions</h5>
				<div class="row justify-content-center">
					<div class="col-6 col-lg-2 text-center">
						<div class="border border-dark border-1 border-radius-md py-3">
							<h6 class="text-warning text-gradient mb-0">Answered</h6>
							<h5 class="font-weight-bolder mb-0"><span class="small">{{ $answeredCount }}</span></h5>
						</div>
					</div>
					<div class="col-6 col-lg-2 text-center">
						<div class="border border-dark border-1 border-radius-md py-3">
							<h6 class="text-success text-gradient mb-0">Correct</h6>
							<h5 class="font-weight-bolder mb-0"><span class="small">{{ $correctAnswer }}</span></h5>
						</div>
					</div>
					<div class="col-6 col-lg-2 text-center mt-sm-4">
						<div class="border border-dark border-1 border-radius-md py-3">
							<h6 class="text-danger text-gradient mb-0">Incorrect</h6>
							<h5 class="font-weight-bolder mb-0"><span class="small">{{ $incorrectAnswer }}</span></h5>
						</div>
					</div>
					<div class="col-6 col-lg-2 text-center mt-sm-4">
						<div class="border border-dark border-1 border-radius-md py-3">
							<h6 class="text-info text-gradient mb-0">Score</h6>
							<h5 class="font-weight-bolder mb-0"><span class="small">{{ $averageCorrect }}%</span></h5>
						</div>
					</div>
				</div>

				<div class="row justify-content-center mt-sm-3 mt-4">
					{{--
					<div class="w-lg-25 w-md-50 text-center">
						<a href="{{ route('question-user') }}" class="btn btn-lg bg-gradient-info text-white font-weight-bolder shadow w-100 mb-sm-1">Write Question</a>
						<p class="mb-0">Write a question to <span class="font-weight-bolder">earn 10 </span><img class="mb-1" alt="coins" width="20" height="auto" src="/assets/svg/ui/coin.svg"></p>
					</div>
					--}}
					
					@if(!$lastSession)
					<button wire:click.prevent="startSession(true)" class="btn btn-lg bg-gradient-medsnapp text-white font-weight-bolder shadow w-lg-20 w-70 mb-sm-2 me-lg-2">Start New Session<span wire:loading wire:target="startSession" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
					@else
					<button wire:click.prevent="startSession(false)" class="btn btn-lg bg-gradient-medsnapp text-white font-weight-bolder shadow w-lg-auto w-70 me-lg-2">Resume Last Session<span wire:loading wire:target="startSession" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
					@endif

					@if($isResetable)
					<button wire:click.prevent="preResetQuestion" class="btn btn-success btn-lg bg-gradient-secondary text-white font-weight-bolder shadow w-lg-20 w-70 mb-sm-1">Reset<span wire:loading wire:target="preResetQuestion" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
					@endif

					<div class="text-center">
						<p class="mb-0">Answer a question to <span class="font-weight-bolder">earn 1 </span><img class="mb-1" alt="coins" width="20" height="auto" src="/assets/svg/ui/coin.svg"></p>
					</div>
				</div>
			</div>
		</div>

		<div class="row justify-content-between">
			<div class="col-lg-6 col-12 mb-2">
				<div class="card card-body with-border p-3">
					<div class="d-flex">
						<h5 class="font-weight-normal w-50 w-sm-60 mb-4">Categories</h5>
						<div class="form-check form-switch w-50 w-sm-40 text-end">
							<input wire:model.live="selectedAllCat" class="form-check-input d-none" type="checkbox" id="switchSel" checked="">
							<label class="form-check-label" for="switchSel"><span class="text-muted">{{$selectedAllCat ? 'Deselect' : 'Select'}} All</span></label>
						</div>
					</div>
					<div>
						@foreach($cats->where('children_count', '>', 0) as $idx => $cat)
							<div class="accordion" id="accordionCat{{$idx}}">
							  <div class="accordion-item mb-1">
								<h5 class="accordion-header" id="heading{{$idx}}">
								  <button class="accordion-button font-weight-normal collapsed opacity-8 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#contentCat{{$idx}}" aria-expanded="false" aria-controls="contentCat{{$idx}}">
									<div wire:key="{{$cat->id}}-cb" class="form-check ps-0 ms-0 me-2">
										<input wire:model.live="selectedCat.{{$cat->id}}" class="form-check-input" type="checkbox" id="checkbox-{{$cat->id}}" checked>
										<label class="custom-control-label text-capitalize font-weight-bolder mt-1" for="checkbox-{{$cat->id}}">
											{{ $cat->name }}
										</label>
									</div>
									<i class="fa fa-chevron-down text-xs mb-1" aria-hidden="true"></i>
									<div class="badge bg-gradient-secondary position-absolute end-0">{{ $cat->children->sum('question_count') }}</div>
								  </button>
								</h5>
								<div id="contentCat{{$idx}}" class="accordion-collapse collapse {{in_array($cat->id, $selectedCat) ? 'show' : ''}}" aria-labelledby="heading{{$idx}}" data-bs-parent="#accordionCat{{$idx}}">
								  <div class="accordion-body">
									
									@foreach($cat->children->sortBy('name') as $subcat)
										<div wire:key="sub-{{$idx}}-{{$loop->index}}-cb" class="form-check ps-4 ms-0 me-4">
											<input wire:model.prevent="selectedSubCat.{{$subcat->id}}" class="form-check-input" type="checkbox" id="sub-{{$idx}}-{{$loop->index}}-cb" checked>
											<label class="custom-control-label text-capitalize" for="sub-{{$idx}}-{{$loop->index}}-cb">
												{{ $subcat->name }}
											</label>
											<span class="badge bg-gradient-secondary float-end">{{ $subcat->question_count }}</span>
										</div>
									@endforeach	

								  </div>
								</div>
							  </div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-12 mt-sm-4 mt-md-4 mt-lg-0 mb-2">
				<div class="card card-body with-border p-3 h-100">
					<div class="d-flex">
						<h5 class="font-weight-normal w-50 w-sm-60 mb-4">Topics</h5>
						<div wire:click.prevent="clearTopic" class="form-check form-switch w-50 w-sm-40 text-end {{ count($topicCollection) ? '' : 'd-none'}}">
							<label class="form-check-label" for="switchSel"><span class="text-muted">Clear Selection</span></label>
						</div>
					</div>
					<div class="input-group input-group-outline mb-4">
						<input type="search" wire:model.live="searchTopic" class="form-control text-white" placeholder="Search">
					</div>

					@if(count($topicCollection))
					<div class="mb-4">
						@foreach($topicCollection as $col)
							<span class="badge bg-gradient-medsnapp">{{$col}}</span>
						@endforeach
					</div>
					@endif

					@foreach($topicsFound as $topic)
						<div wire:key="topic-{{$topic->id}}-cb" class="form-check ms-0 ps-0">
							<input wire:model.live="selectedTopic.{{$topic->id}}" class="form-check-input" type="checkbox" id="topic-{{$topic->id}}-cb">
							<label class="custom-control-label" for="topic-{{$topic->id}}-cb">
								{{ $topic->description }}
							</label>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('preResetQuestion', (event) => {
		Swal.fire({
			icon: "warning",
			title: '<h6>You are about to reset all of your questions and question analytics.<h6>',
			text: "Are you sure you want to do this?",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#8f4ce8",
			cancelButtonColor: "#262629",
			confirmButtonText: "Yes",
			cancelButtonText: "No"
		})
		.then((result) => {
			if (result.isConfirmed) {
				Livewire.dispatch('resetQuestion');
			}
		});
	});

	document.addEventListener('openUpgradeOffers', (event) => {
		Swal.fire({
			title: "Unlock Full Access to MedSnapp! 🔓",
			text: "You’ve reached your free trial limit. Upgrade now to continue accessing MedSnapp’s full features and take your learning to the next level!",
			imageUrl: "/assets/svg/ui/shop.svg",
			imageWidth: 60,
			imageHeight: 60,
			imageAlt: "shop",
			showCancelButton: false,
			showCloseButton: true,
			confirmButtonColor: "#8f4ce8",
			confirmButtonText: "Upgrade Now"
		})
		.then((result) => {
			if (result.isConfirmed) {
				window.open("{{route('subscription')}}", "_self");
			}
		});
	});
</script>