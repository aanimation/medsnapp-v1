<aside id="sidenav-main" class="sidenav navbar navbar-admin navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark">
	<div class="sidenav-header ms-4">
		<i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
			aria-hidden="true" id="iconSidenav"></i>
		<a href="{{ route('dashboard') }}">
			<img width="175" height="auto" src="/assets/img/logos/medsnapp-svg.svg" class="mx-auto" alt="medsnapp_logo">
		</a>
	</div>
	<hr class="horizontal light mt-0 mb-2">
	<div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('dashboard') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">dashboard</i>
					</div>
					<span class="nav-link-text ms-1">Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'notification' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('notification') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">notifications</i>
					</div>
					<span class="nav-link-text ms-1">Push Notification</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'notifs' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('notifs') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">notifications</i>
					</div>
					<span class="nav-link-text ms-1">App Notification</span>
				</a>
			</li>

			<li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs text-white opacity-6">Data</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'user-transaction' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('user-transaction') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">money</i>
					</div>
					<span class="nav-link-text ms-1">Transactions</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ in_array(Route::currentRouteName(),['user-list','user-form','user-detail']) ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('user-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">group</i>
					</div>
					<span class="nav-link-text ms-1">Users</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['patient-list','patient-form','inventory-form']) ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('patient-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">group_add</i>
					</div>
					<span class="nav-link-text ms-1">Patients</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['inventory-list']) ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('inventory-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">list</i>
					</div>
					<span class="nav-link-text ms-1">Inventories</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['question-list','question-form']) ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('question-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">assignment</i>
					</div>
					<span class="nav-link-text ms-1">Questions</span>
				</a>
			</li>

			<li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs text-white opacity-6">Blog</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['post-list','post-form']) ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('post-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">ballot</i>
					</div>
					<span class="nav-link-text ms-1">Posts</span>
				</a>
			</li>

			<li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs text-white opacity-6">Contributor</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['operator-list']) ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('operator-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">group</i>
					</div>
					<span class="nav-link-text ms-1">Admins</span>
				</a>
			</li>

			<li class="nav-item mt-3">
				<h6 class="ps-4 ms-2 text-uppercase text-xs text-white opacity-6">Master</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'specialty-list' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('specialty-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">ballot</i>
					</div>
					<span class="nav-link-text ms-1">Specialities</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'profession-list' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('profession-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">ballot</i>
					</div>
					<span class="nav-link-text ms-1">Professions</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'student-list' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('student-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">ballot</i>
					</div>
					<span class="nav-link-text ms-1">Students</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'badge-list' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('badge-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">ballot</i>
					</div>
					<span class="nav-link-text ms-1">Badges</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'country-list' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('country-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">ballot</i>
					</div>
					<span class="nav-link-text ms-1">Countries</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white {{ Route::currentRouteName() == 'school-list' ? ' active bg-gradient-medsnapp' : '' }}"
					href="{{ route('school-list') }}">
					<div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
						<i class="material-icons opacity-10">ballot</i>
					</div>
					<span class="nav-link-text ms-1">Universities</span>
				</a>
			</li>
			
		</ul>
	</div>
	<div class="sidenav-footer position-absolute w-100 bottom-0 ">
		{{--
		<div class="mx-3">
			<a class="btn bg-gradient-medsnapp w-100" href="/product/livewire" target="_blank">Free Download</a>
		</div>
		<div class="mx-3">
			<a class="btn bg-gradient-medsnapp w-100" href="../../documentation/getting-started/installation.html" target="_blank">View documentation</a>
		</div>
		<div class="mx-3">
			<a class="btn bg-gradient-medsnapp w-100"
				href="/product/livewire" target="_blank" type="button">Upgrade
				to pro</a>
		</div>
		--}}
	</div>
</aside>
