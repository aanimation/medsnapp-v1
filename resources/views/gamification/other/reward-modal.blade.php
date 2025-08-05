<div>
	<div class="modal modal-medsnapp fade" id="modal-rewards" tabindex="-1" role="dialog" aria-labelledby="modal-rewards" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<button type="button" class="btn btn-sm btn-link text-white mb-0 position-absolute end-0 z-index-3 pe-2" data-bs-dismiss="modal" aria-label="Close">
					<span class="material-symbols-outlined">close</span>
				</button>
				<div class="modal-body p-1 m-2">
					<h6 class="modal-title font-weight-normal mb-3">Daily Reward</h6>
					@livewire('other.daily-reward')
				</div>
			</div>
		</div>
	</div>

	@include('gamification.other.option-modal', ['option' => $option])
</div>

<script type="text/javascript">
	window.addEventListener('rewardModalEvent', event => {
		$('#modal-rewards').modal(event.detail.show ? 'show' : 'hide');
	})

	window.addEventListener('optionModalEvent', event => {
		$('#modal-option').modal(event.detail.show ? 'show' : 'hide');
	})
</script>