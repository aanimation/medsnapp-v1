<div id="atts" class="card card-body with-border p-4 pt-3">
	<div class="row">
		<div class="col ps-1">
			<div class="d-flex">
				<div class="pt-2 pe-2">
					<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" x="0" y="0" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 32 32" xml:space="preserve" class=""><g><linearGradient id="a" x1="255.999" x2="255.999" y1="511.999" y2="0" gradientUnits="userSpaceOnUse"><stop stop-opacity="1" stop-color="#00b808" offset="0"></stop><stop stop-opacity="1" stop-color="#afff00" offset="1"></stop></linearGradient><path fill="url(#a)" d="M419.498 188.496A14.979 14.979 0 0 0 405.992 180H310.25l79.16-158.291a15.041 15.041 0 0 0-.645-14.59C386.012 2.695 381.178 0 375.992 0h-180a15.006 15.006 0 0 0-14.033 9.727l-90 240a15.048 15.048 0 0 0 1.699 13.813 15.026 15.026 0 0 0 12.334 6.46h100.781l-55.342 223.367a15.015 15.015 0 0 0 7.91 17.08 15.027 15.027 0 0 0 18.369-4.072l240-302a14.965 14.965 0 0 0 1.788-15.879z" opacity="1" data-original="url(#a)" class=""></path></g></svg>
				</div>
				<div class="w-100 progress-wrapper">
					<div class="progress-info">
						<div class="progress-percentage">
							<span class="text-sm">Energy</span>
							<span wire:poll.visible.5s class="text-xs float-end mt-2"><span wire:stream="healthCounter">{{$currentUser->currentHealth}}</span>/{{$currentUser->maxHealth}} ATP</span>
						</div>
					</div>
					<div class="progress">
						<div wire:poll.visible.5s class="progress-bar bg-gradient-{{ $currentUser->currentHealth > 5 ? 'success' : 'danger' }}" role="progressbar" aria-valuenow="{{$currentUser->currentHealth}}" aria-valuemin="0" aria-valuemax="{{$currentUser->maxHealth}}" style="width: <?= ($currentUser->currentHealth/$currentUser->maxHealth)*100 ?>%;"></div>
					</div>
				</div>
			</div>
			<div class="d-flex">
				<div class="pt-3 pe-2">
					<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="23" height="23" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 23 23" xml:space="preserve" class=""><g><path fill="#ffbe39" d="M493.176 274.813c0 130.983-106.168 237.184-237.201 237.184-131 0-237.15-106.2-237.15-237.184 0-130.975 106.15-237.184 237.15-237.184 131.033 0 237.201 106.209 237.201 237.184z" opacity="1" data-original="#fbb040" class=""></path><path fill="#e38c00" d="M270.676 435.463c-131.001 0-196.551-72.533-233.001-111.434v43.566c10.767 25.301 25.8 48.334 44.2 68.234v-43.9c15.716 17 33.833 31.699 53.9 43.533v43.783a237.552 237.552 0 0 0 44.2 20.25v-43.733c17.184 5.8 35.2 9.8 53.9 11.533v43.634c7.3.666 14.65 1.066 22.1 1.066 7.467 0 14.85-.4 22.135-1.066v-43.634c18.699-1.733 36.715-5.733 53.898-11.533v43.7a235.757 235.757 0 0 0 44.201-20.217v-43.783c20.066-11.834 38.184-26.533 53.9-43.533v43.9c18.398-19.9 33.449-42.934 44.215-68.234v-43.566c-25.533 17.834-72.615 111.434-203.648 111.434zm-157.651-99.834c-9.684-21.633-15.2-45.566-15.2-70.808 0-95.9 77.717-173.65 173.634-173.65 59.332 0 111.666 29.8 142.982 75.191-12.933-70.108-97.298-117.041-167.966-117.041-95.9 0-177.767 86.866-177.767 182.758 0 36.567 2.834 83.2 44.317 103.55z" opacity="1" data-original="#f7941e" class=""></path><path fill="#fce800" d="M255.975.004c-131 0-237.15 106.2-237.15 237.175 0 131.018 106.15 237.185 237.15 237.185 131.033 0 237.201-106.167 237.201-237.185C493.176 106.204 387.008.004 255.975.004zm0 410.826c-95.9 0-173.633-77.75-173.633-173.651 0-95.892 77.733-173.649 173.633-173.649 95.918 0 173.668 77.758 173.668 173.649 0 95.901-77.75 173.651-173.668 173.651z" opacity="1" data-original="#f9ed32" class=""></path></g></svg>
				</div>
				<div class="w-100 progress-wrapper mt-2">
					<div class="progress-warning">
						<div class="progress-percentage">
							<span class="text-sm font-weight-normal">Coins</span>
							<span wire:poll.visible class="text-xs float-end mt-2"><span wire:stream="coinsCounter">{{$currentUser->currentCoins}}</span> PCS</span>
						</div>
					</div>
					<div class="progress">
						<div wire:poll.visible class="progress-bar bg-gradient-{{ $currentUser->currentCoins > 5 ? 'warning' : 'danger'}}" role="progressbar" aria-valuenow="{{$currentUser->currentCoins}}" aria-valuemin="0" aria-valuemax="{{$currentUser->maxCoins}}" style="width:<?= ($currentUser->currentCoins / ($currentUser->currentCoins > 100 ? $currentUser->maxCoins : 100))*100 ?>%;"></div>
					</div>
				</div>
			</div>
			<div class="d-flex">
				<div class="pt-3 pe-2">
					<svg id="Layer_1" enable-background="new 0 0 23 23" width="23" height="23" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientTransform="matrix(1 0 0 -1 0 514.61)" gradientUnits="userSpaceOnUse" x1="255.997" x2="255.997" y1="513.135" y2="5.945"><stop offset="0" stop-color="#26f09b"/><stop offset="1" stop-color="#05a0fa"/></linearGradient><g id="Layer_2_00000121991177140996967070000014725511681718592945_"><g id="star"><path d="m504.4 222.1-106 103.3 25 145.9c2.3 13.7-6.9 26.6-20.5 29-5.4.9-11 0-15.9-2.5l-131-68.9-131 68.9c-12.3 6.5-27.4 1.7-33.9-10.5-2.6-4.9-3.5-10.5-2.5-15.9l25-145.9-106-103.4c-9.9-9.7-10.1-25.6-.5-35.5 3.9-4 8.9-6.5 14.4-7.3l146.5-21.3 65.5-132.7c6.1-12.4 21.2-17.5 33.6-11.4 4.9 2.4 8.9 6.4 11.4 11.4l65.5 132.7 146.5 21.3c13.7 2 23.2 14.7 21.2 28.5-.8 5.4-3.3 10.5-7.3 14.3z" fill="url(#SVGID_1_)"/></g></g></svg>
				</div>
				<div class="w-100 progress-wrapper mt-2">
					<div class="progress-warning">
						<div class="progress-percentage">
							<span class="text-sm">Experience</span>
							<span wire:poll.visible.15s class="text-xs float-end mt-2"><span wire:stream="expsCounter">{{$currentUser->currentExps}}/{{$currentUser->maxExps}}</span> XP</span>
						</div>
					</div>
					<div class="progress">
						<div wire:poll.visible.10s class="progress-bar bg-gradient-{{ $currentUser->currentExps > 5 ? 'info' : 'danger'}}" role="progressbar" aria-valuenow="{{$currentUser->currentExps}}" aria-valuemin="0" aria-valuemax="{{$currentUser->maxExps}}" style="width: <?= ($currentUser->currentExps / $currentUser->maxExps)*100 ?>%;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{--
<!-- DONT REMOVE THIS -->
<div class="col-4">
	<h6 class="font-weight-normal ms-2 mt-2">Sample Button</h6>
	<div wire:click="changeValue('health', {{$decrement}})" class="icon icon-lg icon-shape bg-dark shadow text-center border-radius-xl position-relative m-2 cursor-pointer">
		<i class="material-symbols-outlined opacity-10 text-secondary">heart_minus</i>
		<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x9</span>
	</div>
	<div wire:click="changeValue('health', {{$increment}})" class="icon icon-lg icon-shape bg-dark shadow text-center border-radius-xl position-relative m-2 cursor-pointer">
		<i class="material-symbols-outlined opacity-10 text-secondary">heart_plus</i>
		<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x9</span>
	</div>
	<div wire:click="changeValue('exps', {{$decrement}})" class="icon icon-lg icon-shape bg-dark shadow text-center border-radius-xl position-relative m-2 cursor-pointer">
		<i class="material-symbols-outlined opacity-10 text-secondary">expand_circle_down</i>
		<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x9</span>
	</div>
	<div wire:click="changeValue('exps', {{$increment}})" class="icon icon-lg icon-shape bg-dark shadow text-center border-radius-xl position-relative m-2 cursor-pointer">
		<i class="material-symbols-outlined opacity-10 text-secondary">expand_circle_up</i>
		<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x9</span>
	</div>
	<div wire:click="changeValue('coins', {{$decrement}})" class="icon icon-lg icon-shape bg-dark shadow text-center border-radius-xl position-relative m-2 cursor-pointer">
		<i class="material-symbols-outlined opacity-10 text-secondary">sentiment_dissatisfied</i>
		<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x9</span>
	</div>
	<div wire:click="changeValue('coins', {{$increment}})" class="icon icon-lg icon-shape bg-dark shadow text-center border-radius-xl position-relative m-2 cursor-pointer">
		<i class="material-symbols-outlined opacity-10 text-secondary">sentiment_satisfied</i>
		<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x9</span>
	</div>
	<div wire:click="changeValue('points', {{$decrement}})" class="icon icon-lg icon-shape bg-dark shadow text-center border-radius-xl position-relative m-2 cursor-pointer">
		<i class="material-symbols-outlined opacity-10 text-secondary">add_box</i>
		<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x9</span>
	</div>
	<div wire:click="changeValue('points', {{$increment}})" class="icon icon-lg icon-shape bg-dark shadow text-center border-radius-xl position-relative m-2 cursor-pointer">
		<i class="material-symbols-outlined opacity-10 text-secondary">monitor_weight_loss</i>
		<span class="text-dark text-sm position-absolute bottom-0 end-0 bg-secondary border-radius-md" style="padding: 3px 6px;">x9</span>
	</div>
</div>
--}}

