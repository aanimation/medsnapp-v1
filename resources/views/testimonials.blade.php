<!DOCTYPE html>
<html lang="en">

	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="MedSnapp is a completely unique EdTech platform which combines medical education with gamification to transform the way medical students learn medicine and pass their medical school exams.">
	<meta name="author" content="medsnapp">

	<meta property="og:title" content="Testimonials | MedSnapp" />
	<meta property="og:description" content="MedSnapp is a completely unique EdTech platform which combines medical education with gamification to transform the way medical students learn medicine and pass their medical school exams." />
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

	<body class="bg-black">
	@production
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8V29QPW"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	@endproduction
	
	<div>
		@include('navbar')

		<div id="testimonials">
			<div class="container">
				<div class="row justify-content-center mb-lg-5">
					<div class="col-12 text-center top">
						<script type="text/javascript" src="https://widget.senja.io/js/iframeResizer.min.js"></script>
						<iframe id="wall-of-love-qP0RhZ" src="https://senja.io/p/medsnapp/qP0RhZ?hideNavigation=true&embed=true" title="Wall of Love" frameborder="0" scrolling="no" width="100%"></iframe>
						<script type="text/javascript">document.addEventListener("DOMContentLoaded", function () {iFrameResize({log: false, checkOrigin: false}, "#wall-of-love-qP0RhZ");});</script>
					</div>
				</div>
			</div> <!-- container -->
		</div>
		

	</div> <!-- content -->

	@include('components.materials.footer')

	<!-- JS here -->
	<script src="{{ asset('/materials/js/bootstrap.min.js') }}"></script>    
	
	</body>
</html>
