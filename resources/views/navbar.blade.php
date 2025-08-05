<nav class="navbar navbar-expand-lg"> <!-- fixed-top -->
	<div class="container-fluid">
		<a class="navbar-brand" href="/">
			<img class="top-logo img-responsive" width="180" src="/assets/img/logos/medsnapp-white.png" alt="medsnapp-logo">
			<img class="img-responsive" width="60" src="/assets/img/logos/beta.png" alt="medsnapp-logo">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<div class="wrapper-menu">
			  <div class="line-menu half start"></div>
			  <div class="line-menu"></div>
			  <div class="line-menu half end"></div>
			</div>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mb-lg-0">
				<li class="nav-item d-lg-flex d-md-flex">
					{{-- <a class="nav-link text-white" href="/">Home</a> --}}
					<a class="nav-link text-white{{ Route::currentRouteName() == 'testimonials' ? ' active' : ''}}" href="{{ route('testimonials') }}">Testimonials</a>
					<a class="nav-link text-white{{ Route::currentRouteName() == 'pricing' ? ' active' : ''}}" href="{{ route('pricing') }}">Pricing</a>
					<a class="nav-link text-white" target="_blank" href="https://newsletter.medsnapp.com">Newsletter</a>
					<a class="nav-link text-white{{ Route::currentRouteName() == 'affiliate' ? ' active' : ''}}" href="{{ route('affiliate') }}">Affiliates</a>
				</li>
			</ul>
			<div class="navbar-right d-lg-flex d-md-flex">
				<a class="nav-link text-white" href="{{ route('login') }}">Login</a>
				<a href="{{ route('register') }}" class="btn" type="button">Sign Up</a>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var wrapperMenu = document.querySelector('.wrapper-menu');
		wrapperMenu.addEventListener('click', function(){
	  		wrapperMenu.classList.toggle('open');  
		})
	</script>
</nav>