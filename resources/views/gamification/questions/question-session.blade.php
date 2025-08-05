<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2 px-xl-4 px-xxl-12">

		<div class="col-12 mb-4">
			<div class="card card-body with-border p-3">
				<div class="row justify-content-center">
					<div class="col-4 col-lg-2 text-center">
						<div class="border border-dark border-1 border-radius-md py-3">
							<h6 class="text-info text-gradient mb-0">Correct</h6>
							<h5 class="font-weight-bolder mb-0"><span class="small">{{ $summary['correct'] }}</span></h5>
						</div>
					</div>
					<div class="col-4 col-lg-2 text-center">
						<div class="border border-dark border-1 border-radius-md py-3">
							<h6 class="text-danger text-gradient mb-0">Incorrect</h6>
							<h5 class="font-weight-bolder mb-0"><span class="small">{{ $summary['incorrect'] }}</span></h5>
						</div>
					</div>
					<div class="col-4 col-lg-2 text-center">
						<div class="border border-dark border-1 border-radius-md py-3">
							<h6 class="text-success text-gradient mb-0">Score</h6>
							<h5 class="font-weight-bolder mb-0"><span class="small">{{ $summary['score'] }}%</span></h5>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 mb-2">
			<div class="card" style="border: thin solid #8949e0;">
				<div class="card-body p-3 px-lg-6 px-xl-7">
					<div class="d-flex my-4 my-sm-2">
						<h5 class="w-lg-30 w-md-40 w-sm-60 opacity-7 font-weight-normal mb-sm-4">Question {{ $currentPosition + 1 }} of {{ count($listIds) }}</h5>
						<div class="d-lg-none d-md-none w-sm-30 text-sm-end ms-auto">
							<button wire:click.prevent="endSession('{{$current->skey}}')" class="btn bg-gradient-dark btn-sm px-4" type="button">End<span wire:loading wire:target="endSession" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
						</div>
						<div class="text-center w-lg-40 d-sm-none mt-md-n2 mt-lg-n2">
							<button wire:click.prevent="prevItem" class="btn btn-outline-medsnapp rounded-circle p-0 mb-0 me-3 {{ $currentPosition == 0 ? 'disabled' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Previous Question"><i class="material-icons p-2" style="font-size: 1.5rem;">skip_previous</i></button>
							<button wire:click.prevent="nextItem" class="btn btn-outline-medsnapp rounded-circle p-0 mb-0 {{ $currentPosition == (count($listIds) - 1) ? 'disabled' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Next Question"><i class="material-icons p-2" style="font-size: 1.5rem;">skip_next</i></button>
						</div>
						<div class="w-lg-30 w-md-40 text-end d-sm-none ms-md-auto">
							<button wire:click.prevent="endSession('{{$current->skey}}')" class="btn bg-gradient-dark btn-sm px-4" type="button">End Session<span wire:loading wire:target="endSession" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button>
						</div>
					</div>
					<div class="d-lg-none d-md-none">
						<div class="text-center">
							<button wire:click.prevent="prevItem" class="btn btn-outline-medsnapp rounded-circle p-0 mb-0 me-3 {{ $currentPosition == 0 ? 'disabled' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Previous Question"><i class="material-icons p-2" style="font-size: 1.5rem;">skip_previous</i></button>
							<button wire:click.prevent="nextItem" class="btn btn-outline-medsnapp rounded-circle p-0 mb-0 {{ $currentPosition == (count($listIds) - 1) ? 'disabled' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Next Question"><i class="material-icons p-2" style="font-size: 1.5rem;">skip_next</i></button>
						</div>
					</div>

					<div class="card shadow-none align-items-start pt-2">
						<div class="card-body shadow-none px-md-2 px-sm-0">
							<div class="row gx-lg-8 gx-xl-8 gx-5">
								<div class="col-lg-6">
									<div class="text-white fs-1-1">{!! $current->clinical_vignette !!}</div>
								</div>
								<div class="col-12 col-lg-6 fs-1-1">
									<p><strong>{!! $current->question !!}</strong></p>
									@foreach(json_decode($current->answers, true) as $answer)
										<div class="card card-plain mb-2" 
										@if($picked == $answerLabels[$loop->index] && $isSubmitted)
											style="background-color: {{$isCorrect ? '#408241' : '#972f2d'}};"
										@endif
										>
											<button data-answer="{{$answerLabels[$loop->index]}}" class="btn btn-outline btn-xs hider-item position-absolute shadow-none {{$isSubmitted ? 'd-none':''}}" style="top:30%; left:-2%;">
												<i class="fa fa-{{in_array($answerLabels[$loop->index], $hides) ? 'check' : 'remove'}} text-secondary text-xs"></i>
											</button>
											<div class="card-body choice-item {{$isSubmitted ? 'ps-0 pb-0' : 'p-auto'}} pe-1 d-flex cursor-pointer" data-answer="{{$answerLabels[$loop->index]}}">
												<div class="text-lg {{in_array($answerLabels[$loop->index], $hides) ? 'text-dark' : ''}} font-weight-normal ms-4 my-auto w-80">{{ $answerLabels[$loop->index] }}. {{ $answer['text'] }}</div>
												<div wire:key="answer-{{$current->skey}}-{{$loop->index}}" class="form-check text-center my-auto w-20{{$isSubmitted ? ' d-none' : ''}}">
													<input class="form-check-input cursor-pointer radio-pick-answer" data-answer="{{$answerLabels[$loop->index]}}" type="radio" name="checker-{{$current->skey}}" id="answerRadio{{$loop->index}}">
													<label class="custom-control-label" for="answerRadio{{$loop->index}}"></label>
												</div>
											</div>

											@if($isSubmitted)
											<div class="card-footer p-3">
												{{--
												<h6><span class="font-weight-normal text-{{ $answer['value'] ? 'success' : 'danger'}} text-gradient">{{ $answer['value'] ? 'Correct' : 'Incorrect' }}</span></h6>
												--}}

												@if($stats)
												<div class="progress" style="height: 18px; border-radius: .5em;">
													<div class="progress-bar progress-bar-{{$answer['value'] ?  'success' : 'danger'}}" style="height: 18px; border-radius: inherit; border-top-right-radius: 0; border-bottom-right-radius: 0; width:<?= $stats->{strtolower($answerLabels[$loop->index]).'_res'} ?>%;">
														<div class="progress-value">{{ $stats->{strtolower($answerLabels[$loop->index]).'_res'} }}%</div>
													</div>
												</div>
												@endif

											</div>
											@endif

										</div>
									@endforeach

									<button wire:click.prevent="submitConfirm('{{$current->skey}}')" type="button" class="btn bg-gradient-medsnapp btn-sm text-white mt-2 mb-0 float-end {{$picked ? '' : 'disabled'}} {{$isSubmitted ? 'd-none' : ''}}">Submit<span wire:loading wire:target="submitConfirm" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span></button> 
								</div>
							</div>
						</div>
					</div>
				</div>

				@if($isSubmitted)
				<div class="card-footer p-3 px-lg-6 px-xl-7 mt-4">
					<div class="row gx-lg-8 gx-xl-8 gx-5">
						<!-- Explanation -->
						<div class="col-lg-6">
							<div class="d-flex mt-1">
								<h4 class="w-70 font-weight-normal">Explanation</h4>
								<div class="w-30 text-end">
									<div class="btn btn-icon btn-red btn-md px-2" style="cursor: auto;">
										<span class="btn-inner--icon"><i class="material-icons opacity-0">thumb_up</i></span>
									</div>
								</div>
							</div>
							<hr class="horizontal light mt-0 mb-4">
							@if($current->explanation)
							<div class="row">
								<div class="col-12 mb-4 fs-1-1">
									<h3 class="font-weight-bolder text-white my-3 mb-4">{{ $current->description }}</h3>
									{!! $current->explanation !!}
								</div>
							</div>
							@endif
						</div>
						<!-- End Explanation -->

						<!-- Summary -->
						<div class="col-lg-6">
							<div class="d-flex mt-1">
								<h4 class="w-40 font-weight-normal">Summary</h4>
								<div class="w-60 text-end">
									<button wire:click.prevent="addAction('is_like')" class="btn btn-icon btn-red btn-md px-2 {{ $vote['is_dislike'] ? 'd-none' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Like">
										<span class="btn-inner--icon"><i class="material-icons {{$vote['is_like'] ? 'text-medsnapp' : 'text-white'}}">thumb_up</i></span>
									</button>
									<button wire:click.prevent="addAction('is_dislike')" class="btn btn-icon btn-md px-2 {{ $vote['is_like'] ? 'd-none' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Dislike">
										<span class="btn-inner--icon"><i class="material-icons {{$vote['is_dislike'] ? 'text-medsnapp' : 'text-white'}}">thumb_down</i></span>
									</button>
									<button wire:click.prevent="addAction('is_flag')" class="btn btn-icon btn-md px-2" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Mark">
										<span class="btn-inner--icon"><i class="material-icons {{$vote['is_flag'] ? 'text-medsnapp' : 'text-white'}}">flag</i></span>
									</button>
									<button wire:click.prevent="addAction('is_favorite')" class="btn btn-icon btn-md px-2" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Favorite">
										<span class="btn-inner--icon"><i class="material-icons {{$vote['is_favorite'] ? 'text-medsnapp' : 'text-white'}}">star</i></span>
									</button>
								</div>
							</div>
							<hr class="horizontal light mt-0 mb-5">
							<div class="row">
								@foreach(json_decode($current->answers, true) as $final)
								<div class="col-12 mb-4 fs-1-1">
									<p class="font-weight-bolder mb-2 text-{{$final['value'] ? 'success' : 'danger'}} text-gradient">{{ $answerLabels[$loop->index] }}. {{ $final['text'] }}
									</p>
									<p>{!! $final['note'] !!}</p>
								</div>
								@endforeach
							</div>
						</div>
						<!-- End Summary -->
					</div>

					<div class="row gx-lg-8 gx-xl-8 gx-5 mt-4">
						<div class="col-sm-12 col-md-6 col-lg mb-sm-4">
							<h6 class="font-weight-normal">Comments</h6>
							@if($vote['review'])
								<div class="text-sm shadow-dark p-2" style="border: 2px solid #4d5769;border-radius: 8px;min-height: 80px;">
									{{ $vote['review'] }}
								</div>
							@else
								<div wire:key="review-textarea" class="input-group shadow-dark px-2" style="border: 2px solid #4d5769;border-radius: 8px;">
									<textarea wire:model.blur="review" class="form-control" rows="3" placeholder="Leave a comment" spellcheck="true"></textarea>
								</div>
								<button wire:click.prevent="addText('review')" class="btn btn-lg bg-gradient-dark p-1 px-3 mt-3">Submit</button>
							@endif

						</div>
						<div class="col-sm-12 col-md-6 col-lg">
							<h6 class="font-weight-normal">Suggestions</h6>
							@if($vote['improve'])
								<div class="text-sm shadow-dark p-2" style="border: 2px solid #4d5769;border-radius: 8px;min-height: 80px;">
									{{ $vote['improve'] }}
								</div>
							@else
								<div wire:key="improve-textarea" class="input-group shadow-dark px-2" style="border: 2px solid #4d5769;border-radius: 8px;">
									<textarea wire:model.blur="improve" class="form-control" rows="3" placeholder="Leave a suggestion" spellcheck="true"></textarea>
								</div>
								<button wire:click.prevent="addText('improve')" class="btn btn-lg bg-gradient-dark p-1 px-3 mt-3">Submit</button>
							@endif
						</div>
						
					</div>

					<div class="float-end mt-sm-3 p-3">
						<button wire:click.prevent="prevItem" class="btn btn-outline-medsnapp rounded-circle p-0 mb-0 me-3 {{ $currentPosition == 0 ? 'disabled' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Previous Question"><i class="material-icons p-2" style="font-size: 1.5rem;">skip_previous</i></button>
						<button wire:click.prevent="nextItem" class="btn btn-outline-medsnapp rounded-circle p-0 mb-0 {{ $currentPosition == (count($listIds) - 1) ? 'disabled' : ''}}" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Next Question"><i class="material-icons p-2" style="font-size: 1.5rem;">skip_next</i></button>
					</div>
				</div>
				@endif
			</div>
		</div>
			
	</div>
</div>

@push('js')
<script type="text/javascript">
	$(".choice-item").click(function() {
		$(this).find('input:radio').prop('checked', true);
		Livewire.dispatch('pickAnswer', {'answer': $(this).data('answer')});
	});

	$(".radio-pick-answer").click(function() {
		$(this).prop('checked', true);
		Livewire.dispatch('pickAnswer', {'answer': $(this).data('answer')});
	});

	$(".hider-item").click(function() {
		Livewire.dispatch('hideAnswer', {'answer': $(this).data('answer')});
	});
</script>
@endpush