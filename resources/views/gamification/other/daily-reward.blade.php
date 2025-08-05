<div class="modal-body p-1 m-1">
	<div class="text-center d-sm-none" style="line-height: 14px;">
		@foreach($weeks as $day)
			<div class="icon icon-shape shadow-none border-radius-xl position-relative text-center m-2 mb-0" style="width: 85px;">
				<span class="text-xs text-white opacity-3">{{ $day }}</span>
			</div>
		@endForeach

		@if($firstDOTW > 0)
			@for($i=1;$i<=$firstDOTW;$i++)
				<div class="icon icon-inv-reward icon-shape shadow-none position-relative m-2">
					<span class="position-absolute">&nbsp;</span>
				</div>
			@endfor
		@endif

		@foreach($master as $item)
		<div wire:key="reward-{{$item->id}}" wire:click.prevent="claimDailyReward({{$todayNum == $item->day_num ? $item->id : null}})" class="icon icon-inv-reward icon-shape shadow text-center text-white border-radius-xl position-relative m-2 bg-gradient-{{$todayNum == $item->day_num ? 'medsnapp cursor-pointer' : 'dark'}} {{($todayNum > $item->day_num) ? 'opacity-4' : ($todayNum < $item->day_num ? 'opacity-8' : '')}}" title="{{$item->title}}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-animation="true">

			<span class="font-weight-bolder opacity-5 fs-3 position-absolute start-2 top-10">{{ $item->id }}</span>

			@if($item->type == 'investigation')
			<img width="40" height="auto" src="/assets/svg/{{$item->type}}/{{$item->title}}.svg" class="d-block mx-auto mt-4" />
			@elseif($item->type == 'treatment')
			<img width="40" height="auto" src="/assets/img/small-logos/icon-bulb.svg" class="d-block mx-auto mt-3" />
			@elseif($item->type == 'currency')
			<img width="35" height="auto" src="/assets/svg/ui/{{strtolower($item->title)}}.svg" class="d-block mx-auto mt-4" />
			@else <!-- revive -->
			<img width="30" height="auto" src="/assets/svg/revive/{{$item->route}}.png" class="d-block mx-auto mt-4" />
			@endif

			<span class="text-light text-sm position-absolute bottom-0 end-0 bg-medsnapp-dark border-radius-md" style="padding: 3px 10px;">{{$item->amount}}</span>

			@if(in_array($item->id, $data))
			<div class="position-absolute top-40 start-50">
				<i class="fa fa-check fs-1"></i>
			</div>
			@endif
		</div>
		@endforeach

		@if(7 - $lastDOTW && $lastDOTW !== 0)
			@for($i=1;$i<=(7 - $lastDOTW);$i++)
				<div class="icon icon-inv-reward icon-shape shadow-none  position-relative m-2">
					<span class="position-absolute">&nbsp;</span>
				</div>
			@endfor
		@endif

		<p class="my-0 text-xs">{{date('M. Y')}}</p>
	</div>

	<div class="mx-auto max-width-300 text-center d-md-none d-lg-none" style="min-width: 300px;">
		@foreach($weeks as $day)
			<div class="icon icon-shape shadow-none position-relative text-center m-1 my-0" style="width: 30px;">
				<span class="text-xs text-white opacity-3">{{ Str::limit($day, 2, '') }}</span>
			</div>
		@endForeach

		@if($firstDOTW > 0)
			@for($i=1;$i<=$firstDOTW;$i++)
				<div class="icon icon-inv-reward-sm icon-shape shadow-none position-relative m-1">
					<span class="position-absolute">&nbsp;</span>
				</div>
			@endfor
		@endif

		@foreach($master as $item)
		<div wire:key="reward-{{$item->id}}" wire:click.prevent="claimDailyReward({{$todayNum == $item->day_num ? $item->id : null}})" class="icon icon-inv-reward-sm icon-shape shadow text-center text-white border-radius-md position-relative m-1 bg-gradient-{{$todayNum == $item->day_num ? 'medsnapp cursor-pointer' : 'dark'}} {{($todayNum > $item->day_num) ? 'opacity-4' : ($todayNum < $item->day_num ? 'opacity-8' : '')}}">
			<span class="font-weight-bolder opacity-5 fs-4 position-absolute start-2 top-10">{{ $item->id }}</span>
			@if(in_array($item->id, $data))
			<div class="position-absolute top-20 start-50">
				<i class="fa fa-check"></i>
			</div>
			@endif
		</div>
		@endforeach

		@if(7 - $lastDOTW && $lastDOTW !== 0)
			@for($i=1;$i<=(7 - $lastDOTW);$i++)
				<div class="icon icon-inv-reward-sm icon-shape shadow-none  position-relative m-1">
					<span class="position-absolute">&nbsp;</span>
				</div>
			@endfor
		@endif

		<p class="my-0 text-xs">{{date('M. Y')}}</p>
	</div>
</div>
			