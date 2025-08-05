<div class="">
	<!-- Navbar -->
	<!-- End Navbar -->
	<div class="container-fluid py-4">

		<a href="{{ route('patient-list') }}" class="btn btn-outline position-absolute text-start mb-2 text-danger"><< Back to list</a>
		<h4 class="text-end mb-2">{{ $patient->title }}</h4>

		<!-- EXAMINATION -->
		<div class="row bg-dark py-4 mb-5 border-radius-lg">
			<div class="col-12">
				<h5 class="font-weight-bolder">Examination</h5>
				<ul>
					@foreach($examination as $item)
						<li wire:key="item-ex-{{$loop->index}}">
							<div class="row">
								<div class="col-12 mt-4">{{ $item->name}}</div>
								<hr>
								<div class="col-12">
									@foreach($item->Value as $idx => $value)
									<div wire:key="spec-{{$idx}}" class="d-flex">
										<div class="row">
											@foreach(json_decode($value->specifications, true) as $idx => $spec)
											<div class="col-5">{{ $spec }}</div>
											<div class="col-6">
												<input class="w-95" wire:model.blur="e.{{$item->id}}.{{$idx}}" type="text">
											</div>
											<div class="col-1 text-end">
												<div wire:click.prevent="deleteSpec({{$item->id}},{{$idx}})" class="text-danger cursor-pointer pe-3" title="Delete">X</div>
											</div>
											@endforeach
										</div>
									</div>
									@endforeach
								</div>
								
								<button wire:click="addNewSpec({{$item->id}})" class="btn btn-sm btn-outline-white mb-0 w-auto py-1 ms-2">Add new</button>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		</div>

		<!-- INVESTIGATION -->
		<div class="row">
			<div class="col-12">
				<h5 class="font-weight-bolder">Investigation</h5>
				<ul>
					@foreach($investigation as $item)
						<li wire:key="item-in-{{$loop->index}}">
							<div class="row">
								<div class="col-12 mt-4"><span class="text-warning">{{ $loop->index + 1 }}.</span> {{ $item->name}}</div>
								<hr>
								<div class="col-12">
									@foreach($item->Components as $idx => $comp)
									<div wire:key="comp-{{$idx}}" class="d-flex">
										<div class="w-40" title="{{ $comp->title }}">{{ Str::limit($comp->title, 35) }}</div>
										@if($patient->sex === 'male')
										<div class="w-20" title="{{ $comp->normal }}">{{ Str::limit($comp->normal, 15) }}</div>
										@else
										<div class="w-20" title="{{ $comp->female }}">{{ Str::limit($comp->female, 15) }}</div>
										@endif
										<div class="w-20" title="{{ $comp->patient_val }}">{{ Str::limit($comp->patient_val, 15) }}</div>
										<div class="w-20">
											<input wire:model.blur="i.{{$comp->id}}" type="text">
										</div>
										<div class="w-10">
											<button wire:click="setNewValue('{{$comp->id}}', '{{$item->id}}')" 
											class="btn btn-sm bg-gradient-dark w-100 text-white mb-0 {{ ($i[$comp->id] && $comp->patient_val) ? 'd-none' : '' }}">Set</button>
										</div>
									</div>

									<!-- step 2 -->
									@if(in_array($comp->patient_val, $stepsIncl))
									<div class="mt-2">
										<label>Next Step</label>
										<input wire:model.blur="i_ext.{{$comp->id}}" size="110" type="text">
									</div>
									@endif

									@endforeach
								</div>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		</div>

		<!-- TREATMENT -->
		<div class="row bg-dark py-4 mb-5 border-radius-lg">
			<div class="col-12">
				<h5 class="font-weight-bolder">Treatment</h5>
				<div class="row mt-2">
					<div class="col-4">
						<div class="text-warning">Item</div>
					</div>
					<div class="col-2">
						<div class="text-warning">Dependency</div>
					</div>
					<div class="col-4">
						<div class="text-warning">Alternates</div>
					</div>
					<div class="col-2">
						<div class="text-warning">Recovery</div>
					</div>
				</div>
				@foreach($t as $tIdx => $item)
				<div class="row mt-2">
					<div class="col-4">
						<span class="text-warning me-1">{{$tIdx+1}}.</span>{{$item['inventory']['name']}}
						<span class="font-weight-bolder">{{$item['inventory']['specifications']}}</span>
					</div>
					<div class="col-3">
						@if($item['depend_by'])
						{{ $treatment->where('id',$item['depend_by'])->first()->name }}
						@endif
					</div>
					<div class="col-2">
						@if($item['alternates'])
							@foreach($item['alternates'] as $alt)
								{{ $treatment->where('id',$alt)->first()->name }} <span class="font-weight-bolder">{{$treatment->where('id',$alt)->first()->specifications}}</span>,
							@endforeach
						@endif
					</div>
					<div class="col-2 text-end">
						<input wire:model.blur="t_rec.{{$item['id']}}" size="5" type="text">
						<span class="text-xs">{{ $t_rec[$item['id']]/100 }}%</span>
					</div>
					<div class="col-1 text-end">
						<div wire:click.prevent="deleteTrea({{$item['id']}})" class="text-danger cursor-pointer pe-3" title="Delete">X</div>
					</div>
				</div>
				<hr>
				@endforeach

				<form wire:submit="addMoreTreatment">
					<div class="row mt-4">
						<div class="col-4">
							<div class="input-group input-group-static">
								<label>Select Treatment</label>
								<input wire:model="tre_name" type="search" class="form-control border" placeholder="Select item" list="managements"/>
							</div>
							<div class="input-group input-group-static">
								<label>Select If any dependency</label>
								<input wire:model="tre_depend" type="text" class="form-control border" placeholder="Select item" list="managements" />
							</div>
						</div>
						<div class="col-4">
							<div class="input-group input-group-static">
								<label>Add Alternates</label>
								@for($i=1; $i<6; $i++)
								<input wire:model="tre_alt{{$i}}" type="text" class="form-control border" placeholder="Select Alt {{$i}}" list="managements" />
								@endfor
							</div>
						</div>
						<datalist id="managements">
							@foreach($treatment as $tre)
							<option>{{ucfirst($tre->name)}}{{$tre->specifications ? ' | '.$tre->specifications : ''}}</option>
							@endforeach
						</datalist>
					
						<div class="col-4">
							<button class="btn btn-md btn-outline-white mt-4" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>