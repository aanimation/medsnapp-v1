<li class="nav-item dropdown pe-3 d-flex align-items-center {{auth()->user()->is_active ? '' : 'd-none'}}">
	<a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
		<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 16 16" xml:space="preserve" class=""><g><path d="M21.379 16.913A6.698 6.698 0 0 1 19 11.788V9c0-3.519-2.614-6.432-6-6.92V1a1 1 0 1 0-2 0v1.08C7.613 2.568 5 5.481 5 9v2.788a6.705 6.705 0 0 1-2.388 5.133A1.752 1.752 0 0 0 3.75 20h16.5c.965 0 1.75-.785 1.75-1.75 0-.512-.223-.996-.621-1.337zM12 24a3.756 3.756 0 0 0 3.674-3H8.326A3.756 3.756 0 0 0 12 24z" fill="#d5d5d5" opacity="1" data-original="#000000" class=""></path></g></svg>
	</a>
	<ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
		aria-labelledby="dropdownMenuButton">

		@if($notifications->count())
			@foreach($notifications as $notif)
			<li class="mb-2">
				<a wire:click="markNotifAsRead({{ $notif->id }})" href="{{ $notif->target_url }}" class="dropdown-item border-radius-md">
					<div class="d-flex py-1">
						<div class="my-auto me-3">
							<i class="fa fa-info"></i>
						</div>
						<div class="d-flex flex-column justify-content-center">
							<h6 class="text-sm font-weight-normal mb-1">
								{{$notif->title}}
							</h6>
							<p class="text-xs text-secondary mb-0">
								<i class="fa fa-calendar-check me-1"></i>
								{{$notif->description}}
							</p>
						</div>
					</div>
				</a>
			</li>
			@endforeach
		@endif

		@if($emptyNotifs)
		<li class="mb-2">
			<a class="dropdown-item border-radius-md" href="#">
				<div class="d-flex py-1">
					<div class="d-flex flex-column justify-content-center">
						<p class="text-xs text-secondary mb-0">
							No new notifications
						</p>
					</div>
				</div>
			</a>
		</li>
		@endif

	</ul>
</li>