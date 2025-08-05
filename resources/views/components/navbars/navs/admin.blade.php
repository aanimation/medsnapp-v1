
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
	navbar-scroll="true">
	<div class="container-fluid py-1 px-3">
		<nav aria-label="breadcrumb">
			<h6 class="font-weight-bolder mt-3 text-capitalize"><span class="font-weight-normal">Hi</span> {{ auth()->user()->isAdmin ? auth()->user()->username : auth()->user()->name }}</h6>
		</nav>
		<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

			<div class="ms-md-auto pe-md-3 d-flex align-items-center">
				<!-- empty space -->
			</div>

			<ul class="navbar-nav justify-content-end">
				<li class="nav-item d-xl-none pe-3 d-flex align-items-center">
					<a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
						<div class="sidenav-toggler-inner">
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
							<i class="sidenav-toggler-line"></i>
						</div>
					</a>
				</li>

				<li class="nav-item dropdown pe-3 d-flex align-items-center">
					<a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 16 16" xml:space="preserve" class=""><g><path d="M21.379 16.913A6.698 6.698 0 0 1 19 11.788V9c0-3.519-2.614-6.432-6-6.92V1a1 1 0 1 0-2 0v1.08C7.613 2.568 5 5.481 5 9v2.788a6.705 6.705 0 0 1-2.388 5.133A1.752 1.752 0 0 0 3.75 20h16.5c.965 0 1.75-.785 1.75-1.75 0-.512-.223-.996-.621-1.337zM12 24a3.756 3.756 0 0 0 3.674-3H8.326A3.756 3.756 0 0 0 12 24z" fill="#d5d5d5" opacity="1" data-original="#000000" class=""></path></g></svg>
					</a>
				</li>
				<li class="nav-item dropdown pe-2 d-flex align-items-center">
					<a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButtonProfile"
						data-bs-toggle="dropdown" aria-expanded="false">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 16 16" xml:space="preserve" class=""><g><path d="M256 292.1c33 0 63.5-9.3 87.9-25.1 18.9-12.1 43.5-10.1 60.1 5 46.1 41.8 72.3 101.1 72.2 163.4v26.7c0 27.6-22.4 49.9-50 49.9H85.8c-27.6 0-50-22.3-50-49.9v-26.7c-.2-62.2 26-121.6 72.1-163.3 16.6-15.1 41.3-17.1 60.1-5 24.5 15.7 54.9 25 88 25z" fill="#d5d5d5" opacity="1" data-original="#000000"></path><circle cx="256" cy="123.8" r="123.8" fill="#d5d5d5" opacity="1" data-original="#000000"></circle></g></svg>
					</a>
					<ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
						aria-labelledby="dropdownMenuButtonProfile">
						<li class="mb-0">
							<a class="dropdown-item border-radius-md" href="{{ route('logout') }}">
								<div class="d-flex py-1">
									<div class="d-flex flex-column justify-content-center">
										<h6 class="text-sm font-weight-normal mb-1">
											Sign Out
										</h6>
									</div>
								</div>
							</a>
						</li>
					</ul>
				</li>
				
			</ul>
		</div>
	</div>
</nav>
