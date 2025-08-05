<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2 px-sm-2 px-xl-4 px-xxl-12">
		
		<div class="row">
			<div class="col-12 col-lg-6 mb-4">
				@livewire('user.attributes')
			</div>
			<div class="col-12 col-lg-6 mb-4">
				@livewire('user.levels')
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-lg-4 mb-2">
				<div class="card card-body with-border h-100">
					<!-- scenario board -->
					@include('gamification.patients.boards.quest-desc', ['name' => $quest->name, 'desc' => $quest->description, 'sex' => $quest->sex, 'age' => $quest->age])

					<hr class="my-4">
					
					@include('gamification.patients.boards.quest-health', ['atts' => $quest->attributes, 'healthPatient' => $userQuest->amount])
					<hr class="my-4">
					
					@include('gamification.patients.boards.quest-observ', ['atts' => $quest->attributes])
				</div>
			</div>
			<div class="col-12 col-lg-8 mb-2">
				<div class="card card-body p-0 h-100" style="background-color: transparent !important;">
					@if($userQuest->amount < 1)
						@include('gamification.patients.quest-recovery')
					@else
						<!-- main right -->
						@livewire('patient.inventory-steps', ['userQuest' => $userQuest, 'quest' => $quest])

						@livewire('patient.inv-used', ['userQuest' => $userQuest])
						<!-- end main right -->
					@endif
				</div>
			</div>
		</div> <!-- end row -->

		@livewire('patient.inventory-modal')
		@livewire('patient.route-modal')
		@livewire('patient.revive-modal')
		@livewire('patient.note-modal')

		@if($userQuest->amount > 10)
			@include('gamification.patients.greeting-modal')
		@endif
	</div> <!-- end container -->
</div>

<script type="text/javascript">
	document.addEventListener('livewire:initialized', () => {
		setInterval(() => {
			Livewire.dispatch('reducePatientHealth');
		}, 3600000); // 1 hour in milliseconds

		// Optionally, trigger the update immediately on load
		// Livewire.dispatch('reducePatientHealth');
	});

	document.addEventListener('giveupConfirm', (event) => {
		Swal.fire({
			title: "Are you sure?",
			text: "You will lose 10 reputation.",
			imageUrl: "/assets/svg/ui/warning.svg",
			imageWidth: 60,
			imageHeight: 60,
			imageAlt: "warning",
			showCancelButton: false,
			showCloseButton: true,
			confirmButtonColor: "#8f4ce8",
			confirmButtonText: "Retry"
		})
		.then((result) => {
			if (result.isConfirmed) {
				// location.reload();
				Livewire.dispatch('giveUp');
			}
		});
	});

	window.addEventListener('finishConfirm', () => {
		$('#modal-greeting').modal('show');
	})
</script>
