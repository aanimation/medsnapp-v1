<li class="nav-item ms-auto">

	<div class="btn btn-link border-radius-md p-0 m-0 mt-1" data-bs-toggle="modal" data-bs-target="#modal-rewards">
		<div class="d-flex py-1">
			<div class="my-auto me-2">
				<img width="20" height="auto" src="/assets/svg/ui/gift.svg" class="d-block mx-auto"/>
				<i class="fas fa-circle position-absolute start-40 bottom-10 text-danger blinking{{ $reward ? '' : ' d-none' }}"></i>
			</div>
		</div>
	</div>
	

	<div class="btn btn-link border-radius-md p-0 m-0 mt-1" data-bs-toggle="modal" data-bs-target="#modal-streak">
		<div class="d-flex py-1">
			<div class="my-auto me-2">
				<img width="20" height="auto" src="/assets/svg/ui/energy.svg" class="d-block mx-auto"/>
				<i class="fas fa-circle position-absolute start-40 bottom-10 text-success blinking{{ $energy ? '' : ' d-none' }}"></i>
			</div>
		</div>
	</div>

	<div class="btn btn-link border-radius-md p-0 m-0 mt-1" data-bs-toggle="modal" data-bs-target="#modal-coins">
		<div class="d-flex py-1">
			<div class="my-auto me-3">
				<img width="20" height="auto" src="/assets/svg/ui/coin.svg" class="d-block mx-auto"/>
				<i class="fas fa-circle position-absolute start-40 bottom-10 text-warning blinking{{ $coin ? '' : ' d-none' }}"></i>
			</div>
		</div>
	</div>
</li>