<!-- Pagination and search -->
<div class="row justify-content-between mx-4">
	<div class="col-4">
    <div class="input-group input-group-outline">
      <input type="search" class="form-control text-white" wire:model.live="search" placeholder="search">
    </div>
  </div>
  <div class="col-auto">
		{{ $data->links() }}
	</div>
	<div class="col-auto">
		<div class="dropdown">
			<button class="btn btn-sm bg-gradient-secondary shadow-none dropdown-toggle" type="button" id="pageCountButton" data-bs-toggle="dropdown" aria-expanded="false">per {!! $pageCount !!}</button>
			<ul class="dropdown-menu" aria-labelledby="pageCountButton">
				<li><div class="dropdown-item text-white @if($pageCount == 5)opacity-5 @endif" wire:click.prevent="updatePageCount(5)">per 5</div></li>
				<li><div class="dropdown-item text-white @if($pageCount == 10)opacity-5 @endif" wire:click.prevent="updatePageCount(10)">per 10</div></li>
				<li><div class="dropdown-item text-white @if($pageCount == 15)opacity-5 @endif" wire:click.prevent="updatePageCount(15)">per 15</div></li>
				<li><div class="dropdown-item text-white @if($pageCount == 25)opacity-5 @endif" wire:click.prevent="updatePageCount(25)">per 25</div></li>
				<li><div class="dropdown-item text-white @if($pageCount == 50)opacity-5 @endif" wire:click.prevent="updatePageCount(50)">per 50</div></li>
				<li><div class="dropdown-item text-white @if($pageCount == 100)opacity-5 @endif" wire:click.prevent="updatePageCount(100)">per 100</div></li>
				<li><div class="dropdown-item text-white @if($pageCount == 250)opacity-5 @endif" wire:click.prevent="updatePageCount(250)">per 250</div></li>
			</ul>
		</div>
	</div>
</div>
<!-- End pagination and search -->