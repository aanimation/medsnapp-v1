<!DOCTYPE html>
<html lang="en">

	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="medsnapp, gamification, medical, fun, exam, international, medicine, medical education, medical students, medical school, doctors. MedSnapp, The world’s first gamified medical education platform for medical students. The Fun Way To Pass Your Medical School Exams">
	<meta name="author" content="medsnapp">

	<meta property="og:title" content="The Fun Way To Pass Your Medical School Exams | MedSnapp" />
	<meta property="og:description" content="MedSnapp, The world’s first gamified medical education platform for medical students. Medsnapp, gamification, medical, fun, exam, international, medicine, medical education, medical students, medical school, doctors" />
	<meta property="og:image" content="{{ asset('/assets/app/medsnapp2024.png') }}" />

	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/app/favicon.png') }}">
	<link rel="icon" type="image/png" href="{{ asset('/assets/app/favicon.png') }}">
	<title>{{ config('app.name', 'MedSnapp') }}</title>

	<!-- Google Font -->
	<link rel="stylesheet" href="{{ asset('/materials/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('/materials/css/landing.css?ts='.time()) }}">
	@production
		<!-- First Promotor -->
        @include('components.materials.firstpromotor')
		@include('components.materials.tags')
		@include('components.materials.posthog')
	@endproduction
	</head>

	@production
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-4HNC8PMQ66"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-4HNC8PMQ66');
	</script>
	@endproduction

	<body class="bg-black top-glow">
	@production
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8V29QPW"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	@endproduction
	
	<div>
		@include('navbar')

		<div id="top-cover">
			<div class="container">
				<div class="row gx-0">
					<div class="col-lg-6">
						<div id="top-header" class="text-white">
							<div class="title">Succeed In Your</div>
							<div class="title">Medical School Exams</div>
							<div class="title gradient border-gradient"><span>Through Gamification</span></div>

							<div class="sub-title"><span class="ace">Ace your medical school exams</span> <span class="iu">without</span> the<br>difficulty, stress and boredom.
							<div class="text-lg-start text-sm-center">
								<a href="{{ route('register') }}" class="btn btn-sm get-started-free">Get Started Free</a>
							</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div id="top-header" class="image-1">
							<img class="img-responsive" width="100%" src="/materials/img/landing/img1new.png" alt="image-1">
							{{--
							<div style="position: relative; box-sizing: content-box; max-height: 80vh; max-height: 80svh; width: 100%; aspect-ratio: 1.935483870967742; padding: 40px 0 40px 0;">
								<iframe src="https://app.supademo.com/embed/cm1zqohsh1bci13b3avbmfw2o?embed_v=2" loading="lazy" title="Medsnapp Demo" allow="clipboard-write" frameborder="0" webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
							</div>
							
							--}}
						</div>
						
					</div>
				</div>
			</div>
		</div>

		<div id="partners" class="bg-white">
			<div class="container-fluid">
				<div class="row">
					
					<div class="logos">
						@for($i=0; $i<2; $i++)
						<div class="logos-slide">
							<img class="img-responsive" alt="tech-scaler" src="/assets/partners/Tech-Scaler.png" />
							<img class="img-responsive" alt="barclays-eagle-labs" src="/assets/partners/Barclays-Eagle-Labs.png" />
							<img class="img-responsive" alt="scottish-egde" src="/assets/partners/Scottish-Edge.png" />
							<img class="img-responsive" alt="uofd-cofe" src="/assets/partners/UofD-CofE-Logo.png" />
							<img class="img-responsive" alt="business-gateway" src="/assets/partners/Business-Gateway-new.png" />
							<img class="img-responsive" alt="era-logo" src="/assets/partners/era-logo-new.png" />
							<img class="img-responsive" alt="scottish-enterprise" src="/assets/partners/Scottish-Enterprise-Logo.png" />
							<img class="img-responsive" alt="nhs-cep" src="/assets/partners/NHS-CEP-Logo.png" />
						</div>
						@endfor
					</div>
				</div>
			</div>
		</div>

		<div id="testi">
			<div class="desktop" style="margin: 4em 4em 0 4em;">
				@include('components.materials.senja-landing')	
			</div>
			<div class="mobile">
				@include('components.materials.senja-landing-mobile')
			</div>
		</div>

		<div id="content">
			<div class="container">
				<div class="row">
					<div class="col-12 text-center">
						<div><span class="title" style="color: #CB38FF;">Medical Education</span>  <span id="mid-plus">+</span>  <span class="title" style="color: #8C31E8;">Gamification</span></div>
						<p class="under-curved">Like you've never seen before</p>
					</div>
				</div>
				<div class="row image-2">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
						<div class="position-relative">
							<img class="img-responsive" width="100%" src="/materials/img/landing/img2new.png" alt="image-2">
							<div class="light-box"></div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
						<div class="wrapper right">
							<div class="title gradient genz">Designed For Gen Z<br>Medical Students</div>
							<p>The medical education platform built specifically for the needs of the today's medical students.<br>gamification, community, aesthetic design and so much more.</p>
						</div>
					</div>				
				</div>
			</div> <!-- container -->


			<div class="container">
				<div class="row image-3">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
						<div class="wrapper left">
							<div class="title gradient">Practice Medicine<br>Before You<br>Graduate</div>
							<p>Simulate a doctor’s clinical role.<br>Assess and manage patients virtually in a safe<br>environment before hitting the wards.</p>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
						<div class="position-relative">
							<img class="img-responsive" width="100%" src="/materials/img/landing/img3.png" alt="image-3">
							<div class="light-box"></div>
						</div>
					</div>
				</div>
			</div> <!-- container -->


			<div class="container">
				<div class="row image-4">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
						<div class="position-relative">
							<img class="img-responsive" width="100%" src="/materials/img/landing/img4new.png" alt="image-4">
							<div class="light-box"></div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
						<div class="wrapper right">
							<div class="title gradient">Smash Your Exams<br>Without Being<br>Bored Senseless</div>
							<p>Say goodbye to old-fashioned<br>question banks and boring learning resources.<br>Now, there’s a new way to excel in medical school, whilst having fun.</p>
						</div>
					</div>				
				</div>
			</div> <!-- container -->
		</div>

		<div id="new-bottom">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-9 col-lg-10 col-12">
						<div class="card card-body text-center text-white">
							<h3 style="margin-bottom: 1.3em;">Ready to stop dreading studying medicine?</h3>
							<p style="margin-bottom: 2em;">Level up your medical knowledge.</p>
							<a style="margin: 0 auto 2em;" href="{{ route('register') }}" class="btn btn-sm get-started-free">Get Started Free</a>
							<img style="max-width: 70%; margin: 0 auto;" class="img-responsive" width="100%" src="/materials/img/landing/new-bottom.png" alt="image-4">
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- content -->

	@include('components.materials.footer')
	@include('components.materials.pusher-beams')

	<!-- JS here -->
	<script src="https://getlaunchlist.com/js/widget.js" defer></script>
	<script src="{{ asset('/materials/js/bootstrap.min.js') }}"></script>
	<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
	</body>
</html>
