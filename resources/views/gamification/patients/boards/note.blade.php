<div class="card card-body mb-sm-4 my-4 {{ count($items) ? '' : 'd-none'}}">
	<h5 class="font-weight-normal w-100 mt-1">Findings</h5>
	<div class="row text-center gx-2">
		<div id="carouselFinding" class="carousel slide min-vh-25" data-bs-interval="false">
			<div class="carousel-inner">
				<div class="carousel-item {{ $currentSlide == 'examination' ? 'active' : ''}}">
					<div class="font-weight-bolder mb-4">Examination</div>
					<div class="row justify-content-center gx-1" style="line-height: 14px;">
						@foreach($items->where('type', 'examination') as $item)
						<div class="col-auto text-center">
							<div wire:click.prevent="openNoteModal('{{$item->skey}}', '{{$item->type}}')" class="icon icon-inv-sm icon-shape bg-dark shadow text-center text-white text-xs border-radius-xl position-relative m-1 cursor-pointer p-1 py-4"><span>{{ $item->name }}</span></div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="carousel-item {{ $currentSlide == 'investigation' ? 'active' : ''}}">
					<div class="font-weight-bolder mb-4">Investigation</div>
					<div class="row justify-content-center gx-1" style="line-height: 14px;">
						@foreach($items->where('type', 'investigation') as $item)
						<div class="col-auto text-center">
							<div wire:click.prevent="openNoteModal('{{$item->skey}}', '{{$item->type}}')" class="icon icon-inv-sm icon-shape bg-dark shadow text-center text-white text-xs border-radius-xl position-relative m-1 cursor-pointer p-1 py-4">{{ $item->name }}</div>
						</div>
						@endforeach
					</div>
				</div>
				<div class="carousel-item {{ $currentSlide == 'treatment' ? 'active' : ''}}">
					<div class="font-weight-bolder mb-4">Treatment</div>
					<div class="row justify-content-center gx-1" style="line-height: 14px;">
						@foreach($items->where('type', 'treatment') as $item)
						<div class="col-auto text-center">
							<div wire:click="openNoteModal('{{$item->skey}}', '{{$item->type}}')" class="icon icon-inv-sm icon-shape bg-dark shadow text-center text-white text-xs border-radius-xl position-relative m-1 cursor-pointer p-1 py-4">{{ $item->name }}</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<button class="carousel-control-prev d-sm-none" type="button" data-bs-target="#carouselFinding" data-bs-slide="prev">
				<i class="material-symbols-outlined"  aria-hidden="true" style="color: #8949e0;font-size: 3.3em;">arrow_left</i>
			</button>
			<button class="carousel-control-next d-sm-none" type="button" data-bs-target="#carouselFinding" data-bs-slide="next">
				<i class="material-symbols-outlined"  aria-hidden="true" style="color: #8949e0;font-size: 3.3em;">arrow_right</i>
			</button>
		</div>
	</div>

	@livewire('patient.note-modal')
</div>