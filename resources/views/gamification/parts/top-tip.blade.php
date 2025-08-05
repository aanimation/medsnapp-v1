<div class="row justify-content-center mx-auto {{session()->has('next-route-num') ? 'd-none' : ''}}">
	<div class="card card-body with-border p-3 p-0">
		<h5 class="mb-2 font-weight-normal">Top Tip</h5>
		<p class="mb-0">Make sure to go to the <a href="{{ route('shop') }}">Shop</a> and stock up on inventory for the next patient.</p>
		<p class="mb-0">Buying inventory whilst treating the patient will be significantly more expensive than buying inventory from the <a href="{{ route('shop') }}">Shop</a> in advance.</p>
	</div>
</div>