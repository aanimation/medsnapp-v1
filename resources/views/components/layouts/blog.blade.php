<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @yield('og')
  <meta property="og:image" content="{{ asset('assets/app/medsnapp-logo.png') }}" />

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/app/gamified.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/app/favicon.png') }}">
  <title>{{ config('app.name', 'Blog') }}</title>

  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?ts='.time()) }}?" rel="stylesheet" />

  @production
    @include('components.materials.tags')
    @include('components.materials.posthog')
  @endproduction
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
	@include('blog.nav')

	@yield('content')

	@include('blog.footer')

  <script src="{{ asset('assets/js/font-awesome.js') }}"></script>
	<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

  @production
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6618ec7ca0c6737bd12afe37/1hr8lniep';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
  @endproduction
</body>
</html>
