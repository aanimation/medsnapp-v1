<ul class="nav nav-pills bg-dark mt-sm-4">
	<li class="nav-item">
		<a wire:navigate class="nav-link shadow-none text-white text-sm bg-dark p-3 py-1 {{ Route::currentRouteName() == 'player-profile' ? 'active' : 'opacity-5' }}" href="{{ route('player-profile')}}">Settings</a>
	</li>
	<li class="nav-item">
		<a wire:navigate class="nav-link shadow-none text-white text-sm bg-dark p-3 py-1 {{ Route::currentRouteName() == 'player-security' ? 'active' : 'opacity-5' }}" href="{{ route('player-security')}}">Security</a>
	</li>
	<li class="nav-item">
		<a wire:navigate class="nav-link shadow-none text-white text-sm bg-dark p-3 py-1 {{ Route::currentRouteName() == 'player-bills' ? 'active' : 'opacity-5' }}" href="{{ route('player-bills') }}">Billing</a>
	</li>
</ul>