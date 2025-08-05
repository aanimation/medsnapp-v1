<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta property="og:title" content="MedSnapp | The Fun Way To Pass Your Medical School Exams" />
    <meta property="og:description" content="The world’s first gamified medical education platform for medical students." />
    <meta property="og:image" content="{{ asset('assets/app/medsnapp2024.png') }}" />

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/app/gamified.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/app/favicon.png') }}">
    
    <title>{{ config('app.name', 'Medsnapp') }}</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?ts='.now()) }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/dark-brown-scheme.css?ts='.now()) }}" rel="stylesheet" />
    
    {{--
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    --}}

    @production
        <!-- First Promotor -->
        @include('components.materials.firstpromotor')
        
        @if(Request::segment(1) !== 'manage')
            @include('components.materials.posthog')
        @endif
    @endproduction

    @livewireStyles
</head>

@production
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XG1KG0R854"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-XG1KG0R854');
</script>
@endproduction
    
<body class="g-sidenav-show bg-black dark-brown-version"> <!-- g-sidenav-hidden -->
    @production
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K89QM3CF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endproduction

    @auth
        @livewire('other.reward-modal')
        @livewire('other.coins-modal')
        @livewire('other.energy-modal')
    @endauth

    {{ $slot }}

    <script src="{{ asset('assets/js/font-awesome.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>

    @stack('js')
    
    <script>
        window.addEventListener('livewire:init', () => {
            Livewire.hook('request', ({ fail }) => {
                fail(({ status, preventDefault }) => {
                    if (status === 419) {
                        confirm('Your page expiration behavior...')
                        preventDefault()
                    }
                })
            })
        })
        
        window.addEventListener('swal',function(e){ 
            Swal.fire(e.detail);
        });

        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    @production
        @include('components.materials.pusher-beams')
    @endproduction

    <script async defer src="{{ asset('assets/js/core/buttons.js') }}"></script>
    <script src="{{ asset('assets/js/material-dashboard.js?v='.'3.0.0') }}"></script>
    @livewireScripts
</body>
</html>
