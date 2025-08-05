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
		<div>
			<div class="container">
				<div class="row">
					<div class="col-12">
						@include('components.materials.getLaunchList-form')
					</div>
				</div>
			</div>
		</div>

		<div id="partners" class="bg-white">
			<div class="container-fluid">
				<div class="row">
					
					<div class="logos">
						<div class="logos-slide">
							<img class="img-responsive" alt="scottish-egde" src="/assets/partners/Scottish-Edge.png" />
							<img class="img-responsive" alt="uofd-cofe" src="/assets/partners/UofD-CofE-Logo.png" />
							<img class="img-responsive" alt="business-gateway" src="/assets/partners/Business-Gateway-new.png" />
							<img class="img-responsive" alt="era-logo" src="/assets/partners/era-logo-new.png" />
							<img class="img-responsive" alt="scottish-enterprise" src="/assets/partners/Scottish-Enterprise-Logo.png" />
							<img class="img-responsive" alt="nhs-cep" src="/assets/partners/NHS-CEP-Logo.png" />
						</div>

						<div class="logos-slide">
							<img class="img-responsive" alt="scottish-egde" src="/assets/partners/Scottish-Edge.png" />
							<img class="img-responsive" alt="uofd-cofe" src="/assets/partners/UofD-CofE-Logo.png" />
							<img class="img-responsive" alt="business-gateway" src="/assets/partners/Business-Gateway-new.png" />
							<img class="img-responsive" alt="era-logo" src="/assets/partners/era-logo-new.png" />
							<img class="img-responsive" alt="scottish-enterprise" src="/assets/partners/Scottish-Enterprise-Logo.png" />
							<img class="img-responsive" alt="nhs-cep" src="/assets/partners/NHS-CEP-Logo.png" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="content">
			<div class="container">
				<div class="row m-top">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
						<div class="wrapper left">
							<div class="title gradient">High Quality<br>Medical Education<br>At Your Fingertips</div>
							<p>Learn medicine easier and faster than ever before.<br>No fluff, just high yield content.<br>Study what you need to know then get on<br>with your the rest of your life.</p>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
						<div class="row justify-content-center m-top-mid">
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6">
								<div class="card card-edu text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/tutorials_circle.png" alt="tutorials">
									</div>
									<div class="card-footer">Tutorials</div>
								</div>
							</div>
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6">
								<div class="card card-edu text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/questions_circle.png" alt="questions">
									</div>
									<div class="card-footer">Questions</div>
								</div>
							</div>
						</div>
						<div class="row justify-content-center mt-55">
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6">
								<div class="card card-edu text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/textbook_circle.png" alt="textbook">
									</div>
									<div class="card-footer">Textbook</div>
								</div>
							</div>
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6">
								<div class="card card-edu text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/scenarios_circle.png" alt="scenarios">
									</div>
									<div class="card-footer"><span class="position-absolute start-50 translate-middle">Clinical Scenarios</span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- container -->

			<div class="container">
				<div class="row m-top-m-left">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-push-12">
						<div class="row row-cols-lg-auto">
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6">
								<div class="card card-gam text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/leaderboard.png" alt="leaderboard" width="45" height="45">
									</div>
									<div class="card-footer">Leaderboard</div>
								</div>
							</div>
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6 mx-lg-4">
								<div class="card card-gam text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/badges.png" alt="badges" width="45" height="45">
									</div>
									<div class="card-footer">Badges</div>
								</div>
							</div>
						</div>
						<div class="row row-cols-lg-auto mt-40">
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6">
								<div class="card card-gam text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/levels.png" alt="levels" width="45" height="45">
									</div>
									<div class="card-footer">Levels</div>
								</div>
							</div>
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6 mx-lg-4">
								<div class="card card-gam text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/points.png" alt="points" width="45" height="45">
									</div>
									<div class="card-footer">Points</div>
								</div>
							</div>
						</div>
						<div class="row row-cols-lg-auto mt-40">
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6">
								<div class="card card-gam text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/inventory.png" alt="inventory" width="45" height="45">
									</div>
									<div class="card-footer">Inventory</div>
								</div>
							</div>
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6 mx-lg-4">
								<div class="card card-gam text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/health.png" alt="health" width="45" height="45">
									</div>
									<div class="card-footer">Health</div>
								</div>
							</div>
						</div>
						<div class="row row-cols-lg-auto mt-40">
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6">
								<div class="card card-gam text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/specialty.png" alt="specialty" width="45" height="45">
									</div>
									<div class="card-footer">Speciality</div>
								</div>
							</div>
							<div class="col col-xl-4 col-lg-4 col-md-4 col-sm-6 mx-lg-4">
								<div class="card card-gam text-center text-nowrap fs-4 px-0">
									<div class="card-body">
										<img class='img-responsive' src="/assets/img/accesories/ranks.png" alt="ranks" width="45" height="45">
									</div>
									<div class="card-footer">Ranks</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-pull-12">
						<div class="wrapper right">
							<div class="title gradient">Smash Your Exams<br>Without Being<br>Bored Senseless</div>
							<p>Make studying an enjoyable and frictionless process through gamification.<br>Say goodbye to old-fashioned question banks and boring learning resources.<br>Now, there’s a new way to excel in medical school.</p>
						</div>
					</div>				
			</div>
		</div> <!-- container -->

		<div id="bottom">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-9 col-lg-10 col-12">
						<div class="card text-center text-white bg-transparent">
							<div class="card-body position-relative">
								<div id="join-header" class="position-absolute top-0 start-50 translate-middle bg-dark-purple p-10">Join the Waitlist</div>
								<h3>Sign up for early access and a free trial.</h3>
								<div class="box">&nbsp;</div>
								<div id="invite-only" class="bg-dark-purple p-10">INVITE ONLY</div>
								<h3><u>Limited to 250 places.</u></h3>
								<p>Invitations will be sent on a first come first serve basis<br>to those at the top of the waitlist.</p>
								@include('components.materials.getLaunchList-form')
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
