<!DOCTYPE html>
<html lang="en">

	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="medsnapp, gamification, medical, fun, exam, international, medicine, medical education, medical students, medical school, doctors. MedSnapp, The world’s first gamified medical education platform for medical students. The Fun Way To Pass Your Medical School Exams">
	<meta name="author" content="medsnapp">

	<meta property="og:title" content="Become an affiliate | MedSnapp" />
	<meta property="og:description" content="MedSnapp, The world’s first gamified medical education platform for medical students. Medsnapp, gamification, medical, fun, exam, international, medicine, medical education, medical students, medical school, doctors" />
	<meta property="og:image" content="{{ asset('/assets/app/medsnapp2024.png') }}" />

	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/app/gamified.png') }}">
	<link rel="icon" type="image/png" href="{{ asset('/assets/app/favicon.png') }}">
	<title>{{ config('app.name', 'MedSnapp') }}</title>

	<!-- Google Font -->
	<link rel="stylesheet" href="{{ asset('/materials/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('/materials/css/landing.css?ts='.time()) }}">


	@production
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

	<body class="bg-black" style="background-image: radial-gradient(50% 20% at 50% -8%, rgb(39 12 78) 0%, rgb(0, 0, 0) 100%);">
	@production
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8V29QPW"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	@endproduction
	
	<div>
		@include('navbar')

		<div id="affiliate">
			<div class="container">
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-12">
						<div id="caveat">Affiliate Programme</div>
						<div class="wrapper left">
							<div class="affiliate-title">Become A MedSnapp<br>Affilliate And Earn Money<br>For Each Referral</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-12 text-center">
						<img class="img-responsive" width="60%" src="/materials/img/landing/circles.png" alt="circles">
					</div>
				</div>
			</div> <!-- container -->

			<div id="list" class="container">
				<div class="row">
					<div class="col-12 text-white">
						<h4><u>Here's How:</u></h4>
						<ul>
							<li><div>1 Step</div><div><span>Submit your application.</span></div></li>
							<li><div>2 Step</div><div><span>Wait to hear back.<br>We’ll get back to you ASAP with the Outcome.</span></div></li>
							<li><div>3 Step</div><div><span>Start earning!</span></div></li>
						</ul>
					</div>
				</div>
			</div> <!-- container -->

		</div>

		<div id="join-affiliate">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-9 col-lg-10 col-12">
						<div class="card text-center text-white bg-transparent">
							<div class="card-body position-relative">

								<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdlESPkIi8bnYPLQ9dHwpa8Z_CCSBx64P3kGchIyuB_Acc3Pg/viewform?embedded=true" width="100%" height="800" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- content -->

	@include('components.materials.footer')

	<!-- JS here -->
	<script src="https://getlaunchlist.com/js/widget.js" defer></script>
	<script src="{{ asset('/materials/js/bootstrap.min.js') }}"></script>    
	
	</body>
</html>
