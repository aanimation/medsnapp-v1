@if (in_array(request()->route()->getName(),['front', 'waitlist']))
<x-layouts.front>

	{{ $slot }}

	@include('components.materials.footer')
</x-layouts.front>
@else
<x-layouts.base>
	@if (in_array(request()->route()->getName(),['register', 'login','password.forgot','reset-password', 'payment-status']))
		
		{{ $slot }}

	@elseif (in_array(request()->route()->getName(),['subscription']))
		<x-navbars.navs.auth></x-navbars.navs.auth>

		{{ $slot }}
	@else
		@if(auth()->user()->Role->role_name === 'Player')
			@if(auth()->user()->is_active)
				<x-navbars.left.player-sidebar></x-navbars.left.player-sidebar>
			@else
				<x-navbars.left.profile-sidebar></x-navbars.left.profile-sidebar>
			@endif
		@elseif(auth()->user()->isOperator)
			<x-navbars.left.operator-sidebar></x-navbars.left.operator-sidebar>
		@else <!-- admin -->
			<x-navbars.left.sidebar></x-navbars.left.operator-sidebar>
		@endif

	<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
		@if(auth()->user()->isAdmin || auth()->user()->isOperator)
		<x-navbars.navs.admin></x-navbars.navs.admin>
		@else
		<x-navbars.navs.auth></x-navbars.navs.auth>
			
			{{-- User Onboarding --}}
			@if(session()->has('next-route-num') || !auth()->user()->is_active)
				@livewire('auth.on-boarding')
			@endif
		
		@endif

		{{ $slot }}

		{{-- <x-footers.auth></x-footers.auth> --}}
	</main>
	{{--<x-plugins></x-plugins>--}}
	@endif
</x-layouts.base>
@endif