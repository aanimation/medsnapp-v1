<!DOCTYPE html>
<html lang="en">

	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	<meta name="description" content="MedSnapp is a completely unique EdTech platform which combines medical education with gamification to transform the way medical students learn medicine and pass their medical school exams.">
	<meta name="author" content="medsnapp">

	<meta property="og:title" content="Pricing | MedSnapp" />
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

	<body class="bg-black" style="background-image: radial-gradient(50% 20% at 50% -8%, rgb(39 12 78) 0%, rgb(0, 0, 0) 100%);">
	@production
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8V29QPW"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
	@endproduction
	
	<div>
		@include('navbar')

		<div id="pricing">
			<div class="container">
				<div class="row justify-content-center mb-lg-5">
					<div class="col-8 mx-auto text-center top">
						<h2 style="font-weight: 600; margin-bottom: 5em; line-height: 1.5em;">Simple pricing to help you smash<br>medical school</h2>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-lg-3 col-md-6 col-12 mb-5">
						<div class="card h-100">
							<h4 class="mx-auto mt-4">Free</h4>
							<div class="card-header text-center pt-4 pb-3">
								<h2 class="font-weight-bold mt-2 mb-4">£0<span class="small">/ month</span></h2>
								<h6 class="mx-auto my-3">Free Forever</h6>
								<a href="{{ route('register') }}" class="btn" style="margin-top: 26px;">
									Sign Up Free
								</a>
							</div>
							<div class="card-body text-start pt-0 px-0">
								<div class="text-center">
									<div class="card-title">Limited Access</div>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check text-gray my-auto"></i>
									<span class="ps-3">10 MCQs</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check text-gray my-auto"></i>
									<span class="ps-3">2 Patients</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check text-gray my-auto"></i>
									<span class="ps-3">Limited inventory</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check text-gray my-auto"></i>
									<span class="ps-3">Limited Badges</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check text-gray my-auto"></i>
									<span class="ps-3">Limited Boosts</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-12 mb-5 has-highlight">
						{{--
						<div class="card h-100">
							<h4 class="mx-auto mt-4">Starter</h4>
							<div class="card-header text-center pt-4 pb-3">
								<h2 class="font-weight-bold mt-2 mb-4">£16<span class="small">/ month</span></h2>
								<h6 class="text-decoration-underline mx-auto my-3">£48 Total</h6>
								<a href="{{ route('register') }}" class="btn">
									<span>Get Started</span>
								</a>
							</div>
							<div class="card-body text-start pt-0 px-0">
								<div class="text-center">
									<div class="card-title">3 Months Access</div>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">50 MCQs / Month</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">1 Patients / Week </span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">Unlimited Inventory</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">Unlimited Badges</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">Unlimited Boosts</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check"></i>
									<span class="ps-3">Priority Support</span>
								</div>
							</div>
						</div>
						--}}
						<div class="card highlight h-100"> <!-- normal -->
							<div id="best-value">Recommended</div>
							<h4 class="mx-auto mt-4">Premium</h4>
							<div class="position-absolute" style="top: 33px; right:20px;"><span style="
								background-color: white;
								color: #8C31E8;
								padding: 5px 13px;
								font-weight: 600;
								border-radius: 10px;
							">-25%</span></div>
							<div class="card-header text-center pt-4 pb-3 bg-transparent">
								<h2 class="font-weight-bold mt-2 mb-4"><s>£16</s>&nbsp;&nbsp;£12<span class="small">/ month</span></h2>
								<h6 class="text-decoration-underline mx-auto my-3">£144 Total</h6>
								@auth
								<a href="{{ route('subscription') }}" class="btn">
									<span>Get Started</span>
								</a>
								@else
								<a href="{{ route('register') }}" class="btn">
									<span>Get Started</span>
								</a>
								@endauth

							</div>
							<div class="card-body text-start pt-0 px-0">
								<div class="text-center">
									<div class="card-title">12 Months Access</div>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">50 MCQs / Month</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">1 Patient / Week</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Unlimited Inventory</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Unlimited Badges</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Unlimited Boosts</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Priority Support</span>
								</div>

								<h6 class="mx-auto mt-5 mb-4 text-center">Limited to first 100 Premium Users</h6>

								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline text-medsnapp my-auto"></i>
									<span class="ps-3">25% discount</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline text-medsnapp my-auto"></i>
									<span class="ps-3">MedSnapp Affiliate Scheme - </span>
									<span style="padding-left: 2.5em;">£20/referral</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline text-medsnapp my-auto"></i>
									<span class="ps-3">MedSnapp Merch (T-shirt)</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline text-medsnapp my-auto"></i>
									<span class="ps-3">Exclusive First 100 User Badge </span>
								</div>
							</div>
						</div>
					</div>
					{{--
					<div class="col-lg-3 col-md-6 col-12 mb-5 has-highlight">
						<div class="card highlight h-100">
							<div id="best-value">Best Value</div>
							<h4 class="mx-auto mt-4">Groups</h4>
							<div class="card-header text-center pt-4 pb-3 bg-transparent">
								<h2 class="font-weight-bold mt-2 mb-4">£9<span class="small">user /month</span></h2>
								<h6 class="text-decoration-underline mx-auto my-3">5+ Users</h6>
								<a href="mailto:contact@medsnapp.com" class="btn">
									<span>Contact Sales</span>
								</a>
							</div>
							<div class="card-body text-start pt-0 px-0">
								<div class="text-center">
									<div class="card-title">12 Months Access</div>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">50 MCQs / Month</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">1 Patient / Week</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">Unlimited Inventory</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">Unlimited Badges</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">Unlimited Boosts</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check my-auto"></i>
									<span class="ps-3">Priority Support</span>
								</div>
							</div>
						</div>
					</div>
					--}}
					<div class="col-lg-3 col-md-6 col-12 mb-5">
						<div class="card h-100">
							<h4 class="mx-auto mt-4">Enterprise</h4>
							<div class="card-header text-center pt-4 pb-3">
								<h5 class="font-weight-bold mt-1"><small class="text-lg align-top me-1">Custom Features<br>To Suit Your Needs</small></h5>
								<a href="mailto:contact@medsnapp.com" class="btn" style="margin-top: 4.5em;">
									Contact Sales
								</a>
							</div>
							<div class="card-body text-start pt-0 px-0">
								<div class="text-center">
									<div class="card-title">Bespoke Access</div>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Unlimited MCQs / Month</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">8 Patients / Month</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Unlimited Inventory</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Unlimited Boosts</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Advanced Analytics</span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Super Admin Dashboard </span>
								</div>
								<div class="card-feature p-2 ps-lg-4 ps-5">
									<i class="fa fa-check icon-outline my-auto"></i>
									<span class="ps-3">Priority Support</span>
								</div>
							</div>
						</div>
					</div>
				</div>			
				
				<div class="row mt-5">
					<div class="col-8 mx-auto text-center">
						<h3 class="mt-4 mb-4">100% Money Back Guarantee</h3>
						<p style="font-size: 18px; line-height: 40px; margin-bottom: 3em; font-weight: 200;">We’re so confident you’ll love MedSnapp that If you’re not 100% satisfied,<br>email us <u>within 30 days of purchase</u> and we’ll give you a full refund.</p>
					</div>
				</div>

				<div class="row mt-5">
					<div class="col-md-6 mx-auto text-center">
						<h2 class="opacity-9">Frequently Asked Questions</h2>
					</div>
				</div>
				<div class="row mt-5 mb-5">
					<div class="col-md-8 mx-auto">
						<div class="accordion text-start" id="accordionfaq">
							<div class="accordion-item my-2">
								<h5 class="accordion-header" id="headingOne">
									<button class="accordion-button border-bottom text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"> <!-- aria-expanded="true" -->
										What is MedSnapp?
									</button>
								</h5>
								<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionfaq"> <!-- show -->
									<div class="accordion-body text-sm opacity-8">
										MedSnapp is a completely unique EdTech platform which combines medical education with gamification to transform the way medical students learn medicine and pass their medical school exams. 
										<br><br>
										You will diagnose and treat virtual patients using medical inventory purchased with game currency, and answer questions on our gamified question bank. This is all in addition to numerous other features including badges, boosts and competing against your peers to move up the leaderboard.

									</div>
								</div>
							</div>
							<div class="accordion-item my-2">
								<h5 class="accordion-header" id="headingTwo">
									<button class="accordion-button border-bottom text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										How Do I Sign Up?
									</button>
								</h5>
								<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionfaq">
									<div class="accordion-body text-sm opacity-8">
										Simply click the <a href="{{ route('register') }}" target="_blank" class="fw-light text-decoration-none">“Sign Up”</a> button and follow the instructions.
									</div>
								</div>
							</div>
							<div class="accordion-item my-2">
								<h5 class="accordion-header" id="headingThree">
									<button class="accordion-button border-bottom text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Can I Try MedSnapp Before I Purchase a Subscription?
									</button>
								</h5>
								<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionfaq">
									<div class="accordion-body text-sm opacity-8">
										Yes, you will have access to our <a href="{{ route('login') }}" class="fw-light text-decoration-none">demo</a> features to try out the platform before deciding to purchase a subscription.
									</div>
								</div>
							</div>
							<div class="accordion-item my-2">
								<h5 class="accordion-header" id="headingFour">
									<button class="accordion-button border-bottom text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
										How much medical content does MedSnapp have?
									</button>
								</h5>
								<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionfaq">
									<div class="accordion-body text-sm opacity-8">
										We are uploading 50 questions and 4 patients to the platform every month for paid users, starting from October 2024.<br><br>
										We aim to increase the amount and variety of content in the future as we grow.
									</div>
								</div>
							</div>
							<div class="accordion-item my-2">
								<h5 class="accordion-header" id="headingFifth">
									<button class="accordion-button border-bottom text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
										What perks do I get as an early user?
									</button>
								</h5>
								<div id="collapseFifth" class="accordion-collapse collapse" aria-labelledby="headingFifth" data-bs-parent="#accordionfaq">
									<div class="accordion-body text-sm opacity-8">
										Yes, our first 100 paid users will get access to:<br>
										<ol>
											<li>&bull; MedSnapp affiliate scheme - earn £25 for every 12 month subscription referral</li>
											<li>&bull; MedSnapp t-shirt</li>
											<li>&bull; First 100 user WhatsApp group with the founder of MedSnapp</li>
											<li>&bull; Bespoke first 100 user badge on MedSnapp</li>
										</ol>
										Please note, these bonuses will not be available after the first 100 slots are filled.
									</div>
								</div>
							</div>
							<div class="accordion-item my-2">
								<h5 class="accordion-header" id="headingSixth">
									<button class="accordion-button border-bottom text-black" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixth" aria-expanded="false" aria-controls="collapseSixth">
										Do you offer plans for educational institutions?
									</button>
								</h5>
								<div id="collapseSixth" class="accordion-collapse collapse" aria-labelledby="headingSixth" data-bs-parent="#accordionfaq">
									<div class="accordion-body text-sm opacity-8">
										Yes, reach out via <a href="mailto:contact@medsnapp.com" class="fw-light text-decoration-none">email</a> and we will share the options available.
									</div>
								</div>
							</div>
						</div>
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
