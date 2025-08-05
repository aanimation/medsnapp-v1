<div class="container-fluid py-2 {{session()->has('next-route-num') ? '' : 'd-none'}}">
	<div class="card my-2">
		<div class="bg-gradient-dark shadow-lg border-radius-lg pt-4 pb-3">
			<div class="multisteps-form__progress d-sm-none">
				<button class="multisteps-form__progress-btn text-white" type="button" title="Profile">
					<span>Profile</span>
				</button>
				<button class="multisteps-form__progress-btn {{session()->get('next-route-num') > 0 ? 'text-white' : ''}}" type="button" title="Walkthrough">Walkthrough</button>
				<button class="multisteps-form__progress-btn {{session()->get('next-route-num') > 1 ? 'text-white' : ''}}" type="button" title="Shop">Shop</button>
				<button class="multisteps-form__progress-btn {{session()->get('next-route-num') > 2 ? 'text-white' : ''}}" type="button" title="Patient">Patient</button>
			</div>
			<div class="d-lg-none d-md-none text-center">
				<span class="px-2 text-white text-bold">Profile</span>
				<span class="px-2{{session()->get('next-route-num') > 0 ? ' text-white text-bold' : ''}}">Walkthrough</span>
				<span class="px-2{{session()->get('next-route-num') > 1 ? ' text-white text-bold' : ''}}">Shop</span>
				<span class="px-2{{session()->get('next-route-num') > 2 ? ' text-white text-bold' : ''}}">Patient</span>
			</div>
			<div class="text-center mt-2 mb-0">
				@if($isFinished)
				<button wire:click="setPrevBoard({{session()->get('next-route-num')}})" class="btn btn-md text-white text-bold shadow mt-lg-2 w-lg-10 w-md-30 w-sm-30 mx-auto mb-0 {{$profileCompleted ? '' : 'disabled'}} {{$currentStep == 0 ? 'd-none' : ''}}" style="background-color: #8f4ce8;">Back</button>
				<button wire:click="destroyBoard" class="btn btn-md text-white text-bold shadow mt-lg-2 w-lg-10 w-md-30 w-sm-30 mx-auto mb-0" style="background-color: #8f4ce8;">Done</button>
				@else
				<button wire:click="setPrevBoard({{session()->get('next-route-num')}})" class="btn btn-md text-white text-bold shadow mt-lg-2 w-lg-10 w-md-30 w-sm-30 mx-auto mb-0 {{$profileCompleted ? '' : 'disabled'}} {{$currentStep == 0 ? 'd-none' : ''}}" style="background-color: #8f4ce8;">Back</button>
				<button wire:click="setNextBoard({{session()->get('next-route-num')}})" class="btn btn-md text-white text-bold shadow mt-lg-2 w-lg-10 w-md-30 w-sm-30 mx-auto mb-0 {{$profileCompleted ? '' : 'disabled'}}" style="background-color: #8f4ce8;">Next</i></button>
				@endif
			</div>
		</div>

	</div>
</div>
