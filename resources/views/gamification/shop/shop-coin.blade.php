<div wire:poll.visible class="d-flex text-end">
	<div class="w-auto p-2 px-lg-3 py-lg-1 font-weight-bolder bg-black border-offer border-1 text-center me-2" style="border-radius: 12px;">
		<img class="mb-1" alt="coins" width="20" height="auto" src="/assets/svg/ui/energy.svg"/> {{ auth()->user()->currentHealth }}
	</div>
	<div class="w-auto p-2 px-lg-3 py-lg-1 font-weight-bolder bg-black border-offer border-1 text-center" style="border-radius: 12px;">
		<img class="mb-1" alt="coins" width="20" height="auto" src="/assets/svg/ui/coin.svg"/> {{ auth()->user()->currentCoins }}
	</div>
</div>

