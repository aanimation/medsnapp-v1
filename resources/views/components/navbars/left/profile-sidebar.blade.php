<aside id="sidenav-main" class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark">
    <div class="sidenav-header text-center">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
            <a href="#" class="align-items-center pe-3">
                <img width="175" height="auto" src="/assets/img/logos/medsnapp-svg.svg" class="h-100" alt="medsnapp_logo">
            </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">            
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white bg-gradient-medsnapp active"
                    href="#">
                    <div class="text-white text-center ms-2 me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10" style="font-size: 2rem;">rocket</i>
                    </div>
                    <span class="nav-link-text ms-1">{{ ucfirst(Request::segment(2)) }}</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
