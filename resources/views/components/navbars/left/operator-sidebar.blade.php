<aside id="sidenav-main" class="sidenav navbar navbar-admin navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark">
    <div class="sidenav-header ms-4">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a href="{{ route('dashboard') }}">
            <img width="175" height="auto" src="/assets/img/logos/medsnapp-svg.svg" class="mx-auto" alt="medsnapp_logo">
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Operator</h6>
            </li>
            @if(auth()->user()->username === 'patient-op')
            <li class="nav-item">
                <a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['patient-list','patient-form','inventory-form']) ? ' active bg-gradient-medsnapp' : '' }}"
                    href="{{ route('patient-list') }}">
                    <div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">group_add</i>
                    </div>
                    <span class="nav-link-text ms-1">Patients</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->username === 'question-op')
            <li class="nav-item">
                <a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['question-list','question-form']) ? ' active bg-gradient-medsnapp' : '' }}"
                    href="{{ route('question-list') }}">
                    <div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">Questions</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->username === 'blog-op')
            <li class="nav-item">
                <a class="nav-link text-white {{ in_array(Route::currentRouteName(), ['post-list','post-form']) ? ' active bg-gradient-medsnapp' : '' }}"
                    href="{{ route('post-list') }}">
                    <div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">ballot</i>
                    </div>
                    <span class="nav-link-text ms-1">Posts</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="card shadow-none bg-transparent text-center position-absolute bottom-0 w-100 {{ Route::currentRouteName() == 'invite' ? 'd-none' : '' }}">
        <div class="card-body">
            <a href="{{ route('logout') }}" class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md mb-2">
                <i class="material-icons opacity-10" aria-hidden="true">logout</i>
            </a>
            <p class="text-sm font-weight-normal mb-2">Sign Out</p>
        </div>
    </div>
</aside>
