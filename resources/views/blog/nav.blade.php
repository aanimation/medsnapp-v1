<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 h-6em shadow-none navbar-transparent">
  <div class="container">
    <a class="position-relative ps-5 pb-3" href="/"> <img width="180" src="/assets/img/logos/medsnapp-white.png"></span>
    </a>

    @if(Route::currentRouteName() !== 'post-detail')
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>

    <div class="collapse navbar-collapse w-100 pt-3 pb-2" id="navigation">
      <ul class="navbar-nav navbar-nav-hover ml-auto pt-3">
        @foreach($cats as $cat)
        <li class="nav-item cursor-pointer mx-2">
          <a href="/{{ $cat->slug }}" role="button" class="nav-link ps-2 d-flex justify-content-between align-content-center text-md"> {{ $cat->name }}
          </a>
        </li>
        @endforeach
        <li class="nav-item cursor-pointer mx-2">
          <a href="https://medicalsnippets.beehiiv.com/" target="_blank" role="button" class="nav-link ps-2 d-flex justify-content-between align-content-center text-md">Newsletter</a>
        </li>
      </ul>

      <ul class="navbar-nav d-lg-block d-none">
        <li class="nav-item cursor-pointer mx-2 pt-3 pe-5">
          <a id="early-access" href="/" role="button" class="nav-link ps-2 d-flex justify-content-between align-content-end text-md">Get Early Access</a>
        </li>
      </ul>
    </div>
    @endif

  </div>
</nav>