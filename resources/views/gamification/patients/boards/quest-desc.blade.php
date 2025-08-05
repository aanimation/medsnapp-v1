<div>
	<h5 class="font-weight-normal w-100 mt-1">Patient</h5>
	<h6>{{ $name }} <span class="material-symbols-outlined">{{ $sex ?? 'male' }}</span> <span class="text-sm text-end">{{$age ?? ''}} years old</span></h6>
	<p class="mb-0 text-dark">{{ $desc }}</p>
</div>