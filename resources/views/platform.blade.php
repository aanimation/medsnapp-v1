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

	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/app/gamified.png') }}">
	<link rel="icon" type="image/png" href="{{ asset('/assets/app/gamified.png') }}">
	<title>{{ config('app.name', 'MedSnapp') }}</title>

	<!-- Google Font -->
	<link rel="stylesheet" href="{{ asset('/materials/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/materials/css/style.css?ts='.time()) }}">

	@production
    @include('components.materials.tags')
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
		<div id="top-cover">
			<div class="position-relative">
				<div class="position-absolute">
					<img class="img-responsive" width="180" src="/assets/img/logos/medsnapp-white.png" alt="medsnapp-logo">
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div id="top-header" class="text-center text-white">
							<div class="title">Guarantee Success<br>In Your</div>
							<div class="title gradient">Medical School Exams</div>
							<div class="box">&nbsp;</div>
							<div class="sub-title"><span class="ace">Ace your medical school exams</span> <span class="iu">without</span> the<br>difficulty, stress and boredom.</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="bottom">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-9 col-lg-10 col-12">
						<div class="card text-center text-white bg-transparent">
							<div class="card-body position-relative">
								<div id="join-header" class="position-absolute top-0 start-50 translate-middle bg-dark-purple p-10">Join and Start</div>
								<h3>Sign up for early access and a free trial.</h3>
								<div class="box">&nbsp;</div>
								<div id="invite-only" class="bg-dark-purple p-10">
									<a href="{{ route('register') }}">Sign Up</a>
								</div>
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
