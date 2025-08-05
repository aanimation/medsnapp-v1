<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="gamification, medical, fun, exam, international, medicine, medical education, medical students, medical school, doctors">
    <meta name="author" content="medsnapp">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/app/gamified.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/assets/app/favicon.png') }}">
    <title>{{ config('app.name', 'MedSnapp') }}</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('/materials/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/materials/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/materials/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/materials/css/style.css?ts='.time()) }}">
    
    @livewireStyles
  </head>

  @production
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
    
    {{ $slot }}

    {{-- @include('components.materials.modal') --}}

    <!-- JS here -->
    <script src="https://getlaunchlist.com/js/widget.js" defer></script>
    <script src="{{ asset('/materials/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/materials/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/materials/js/bootstrap.min.js') }}"></script>

    <script>
      $('.owl-carousel').owlCarousel({
        autoplay:true,
        loop:true,
        // margin:10,
        nav:false,
        responsive:{
          0:{
            items:2
          },
          600:{
            items:3
          },
          1000:{
            items:5
          }
        }
      })
    </script>
    
    @livewireScripts
  </body>
</html>