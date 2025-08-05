<div>
	@if($type === 'investigation' && $category === 'Imaging')
	<div class="d-flex text-sm pb-1">
		<div class="w-100 text-center text-white ps-3">{!! $hasDescription ? $val->pasca : $val->patient !!}</div>
	</div>
	@else
	<div class="d-flex text-sm pb-1">
		<div class="w-40 text-start ps-3">{{ $com->title }}</div>
		<div class="w-30 text-center text-white ps-3">{!! $hasDescription ? $val->pasca : $val->patient !!}</div>

		<div class="w-30 text-end pe-3">{{ $sex === 'female' ? $com->female : $com->normal }} {{ $com->unit }}</div>
	</div>
	@endif

	@if($val->description && !$hasDescription)
		<div class="text-center text-warning p-5">{{ $val->description }}</div>
	@endif
</div>