<div class="modal modal-medsnapp fade" id="modal-preview" tabindex="-1" role="dialog" aria-labelledby="modal-coins" aria-hidden="true" data-bs-keyboard="false"> 
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-body modal-body-medsnapp">

				@if($data)
				<div class="row">
					<div class="col-6">
						<div class="text-white">{!! $data->clinical !!}</div>

						<!-- topic: title and description -->
						<h4 class="text-white font-weight-bolder">{{ $data['description'] }}</h4>
						{{--
						<div class="text-white">{!! $data->explanation !!}</div>
						--}}
						<div class="row">
						  <div class="col-12">
						    <div class="accordion"> <!-- id="accordionQuestionDetail" -->
						      <div class="accordion-item mb-3">
						        <h5 class="accordion-header" id="headingOne">
						          <button class="accordion-button border-bottom font-weight-normal collapsed opacity-8 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
						            Clinical Vignette <i class="fa fa-chevron-down text-xs ms-2" aria-hidden="true"></i>
						          </button>
						        </h5>
						        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionQuestionDetail" style="">
						          <div class="accordion-body">
						            <div class="text-white">{!! $data->clinical_vignette !!}</div>
						          </div>
						        </div>
						      </div>
						      <div class="accordion-item mb-3">
						        <h5 class="accordion-header" id="headingTwo">
						          <button class="accordion-button border-bottom font-weight-normal opacity-8 pb-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
						            Topic Description <i class="fa fa-chevron-down text-xs ms-2" aria-hidden="true"></i>
						          </button>
						        </h5>
						        <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionQuestionDetail">
						          <div class="accordion-body">
						            <div class="text-white">{!! $data->explanation !!}</div>
						          </div>
						        </div>
						      </div>
						    </div>
						  </div>
						</div>
					</div>
					<div class="col-6">
						<p><strong>{!! $data->question !!}</strong></p>
						@foreach(json_decode($data->answers) as $item)
							<div class="card card-plain mb-2">
								<div class="card-body p-2 pt-3 d-flex">
									<div class="text-sm font-weight-normal mb-0 w-80 ms-2">{{ $answerLabels[$loop->index] }}. {{ $item->text }}</div>
									<div wire:key="item-{{$loop->index}}" class="form-check w-15">
										<input class="form-check-input" type="radio" name="checker-preview" id="answerRadio{{$loop->index}}" @if($data->answer == $loop->index) checked @endif>
										<label class="custom-control-label" for="answerRadio{{$loop->index}}"></label>
									</div>
								</div>
								<div class="card-footer p-2 ps-3">
									<h6><span class="font-weight-normal {{ $data->answer == $loop->index ? 'text-success' : 'text-secondary'}}">{{ $data->answer == $loop->index ? 'Correct' : 'Incorrect' }}</span></h6>
									<p class="text-xs">{!! $item->note !!}</p>
								</div>
							</div>
						@endforeach
					</div>
				</div>
				@endif
					

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.addEventListener('previewModalEvent', event => {
		$('#modal-preview').modal(event.detail.show ? 'show' : 'hide');
	})
</script>