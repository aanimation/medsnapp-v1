<div style="min-height: 80vh!important;">
	<div class="container-fluid py-2 px-sm-2 px-xl-4 px-xxl-12">
		<div class="row mx-0">
			<div class="card card-body with-border d-sm-none mb-4">
				<div class="row justify-content-between">
					<div class="col-auto d-sm-8 d-md-6">
						<h5 class="font-weight-normal">Need Help?</h5>
					</div>
					<div class="col-auto d-sm-4 d-md-6">
						<ul class="nav nav-pills bg-dark text-end" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link {{ $tab == 'video' ? 'active' : '' }} shadow-none text-white text-sm p-3 py-1" id="walkthrough-tab" data-bs-toggle="tab" data-bs-target="#walkthrough" type="button" role="tab" aria-controls="walkthrough" aria-selected="true">Walkthrough</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link {{ $tab == 'form' ? 'active' : '' }} shadow-none text-white text-sm p-3 py-1" id="contact-form-tab" data-bs-toggle="tab" data-bs-target="#contact-form" type="button" role="tab" aria-controls="contact-form" aria-selected="false">Contact Form</button>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="card card-body with-border text-center mb-4 p-4">
				<div class="p-0">Check our <a class="font-weight-bolder" href="https://medsnapp.notion.site/Help-Center-11b0d9f9cae681528f5ecd1e8231c520" target="_blank">Help Centre</a> for User Guides and FAQs.</div>
			</div>

			<div class="card card-body with-border mb-2">
				<h5 class="font-weight-normal mb-sm-2 d-lg-none">Walkthrough</h5>
				<div class="tab-content mb-3">
					<div class="tab-pane fade {{ $tab == 'video' ? 'show active' : '' }}" id="walkthrough" role="tabpanel" aria-labelledby="walkthrough-tab">
						@include('gamification.other.video-walkthrough')
					</div>
					<div class="tab-pane fade {{ $tab == 'form' ? 'show active' : '' }}" id="contact-form" role="tabpanel" aria-labelledby="contact-form-tab">
						@include('gamification.other.contact-msg')
					</div>
				</div>
			</div>

			<div class="d-md-none p-sm-0">
				<div class="card card-body with-border mb-4">
					<h5 class="font-weight-normal mb-sm-2 d-lg-none">Need Help?</h5>
					@livewire('other.contact-message')
				</div>
			</div>
		</div>
	</div>
</div>