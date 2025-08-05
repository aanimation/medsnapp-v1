<div class="">
	<!-- Navbar -->
	<!-- End Navbar -->
	<div class="container-fluid py-4">
		<form wire:submit.prevent="submit">
			<div class="row">
				<div class="col-12 mb-4">
					<div class="p-4">
						<div class="row">
							<div class="col-6">
								<div class="input-group input-group-static mb-4">
									<label>Title</label>
									<input wire:model="title" type="text" class="form-control @error('title')is-invalid @enderror">
									@error('title')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-6">
								<div class="input-group input-group-static mb-4">
									<label>Slug</label>
									<input wire:model="slug" type="text" class="form-control @error('slug')is-invalid @enderror">
									@error('slug')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-12">
								<div class="input-group input-group-static mb-4">
									<label>Excerpt</label>
									<textarea wire:model="excerpt" rows="2" class="form-control @error('excerpt')is-invalid @enderror"></textarea>
									@error('excerpt')
										<span class="text-xs text-warning">{{ $message }}</span>
									@enderror
								</div>
							</div>
						</div>
						<div wire:ignore class="input-group input-group-static mb-4">
							<label>Content</label>
							<textarea id="content-editor" wire:model.defer="content" rows="10" class="form-control @error('content')is-invalid @enderror"></textarea>
							@error('content')
								<span class="text-xs text-warning">{{ $message }}</span>
							@enderror
						</div>
						<div class="row">
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Category</label>
									<input list="categories" wire:model="category" type="text" class="form-control ">
									<datalist id="categories">
										@foreach($categories as $cat)
									  		<option value="{{ $cat->name }}">
									  	@endforeach
									</datalist>
								</div>
							</div>
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Author</label>
									<input list="authors" wire:model="author" type="text" class="form-control ">
									<datalist id="authors">
										@foreach($authors as $author)
									  		<option value="{{ $author->name }}">
									  	@endforeach
									</datalist>
								</div>
							</div>
							<div class="col-4">
								<div class="input-group input-group-static mb-4">
									<label>Tags</label>
									<input type="text" class="form-control">
								</div>
							</div>
						</div><!-- end row -->
						<div class="text-center">
							<a href="{{ route('post-list') }}" class="btn bg-secondary text-white font-weight-bolder w-lg-20 mb-0">Back</a>
							<button type="submit" wire:submitt.prevent="submit" class="btn bg-gradient-medsnapp text-white font-weight-bolder w-lg-20 w-sm-60 mb-0 mt-sm-4">Submit <span wire:loading>Saving in progress..</span></button>
						</div>
					</div>
				</div>
				{{--
				<div class="w-100 text-center" wire:loading wire:target="submit">
					<h5>Saving in progress..</h5>
				</div>
				--}}
			</div>
		</form>
	</div>
	
	<style type="text/css">
		.ck.ck-editor__main>.ck-editor__editable {
			background: #131828;
/*			color: black;*/
			min-height: 200px;
			min-width: 800px;
		}

		/*.ck.ck-editor__main>.ck-editor__editable p a {
			color: black!important;
		}*/

		@media (max-width: 992px) {
			.ck.ck-reset_all {
				width: 700px;
			}

			.ck.ck-editor__main>.ck-editor__editable {
				min-height: 300px;
				max-width: 700px;
				width: 700px;
			}
		}

		@media (max-width: 480px) {
			.ck.ck-reset_all {
				width: 340px;
			}

			.ck.ck-editor__main>.ck-editor__editable {
				min-height: 300px;
				min-width: 340px;
				width: 340px;
			}
		}
	</style>
</div>



<script src="/assets/js/plugins/ckeditor.js"></script>
<script>
	document.addEventListener('livewire:initialized', () => {
		var contentEditor;

		ClassicEditor.defaultConfig = {
			toolbar: {
				items: ['undo','redo','heading',
					'|','bold','italic',
					'strikethrough','subscript','superscript','code',
					'|','alignment','fontsize','fontColor','fontBackgroundColor',
					'|','bulletedList','numberedList',
					'outdent', 'indent',
					'|','insertTable','link',
				],
				// shouldNotGroupWhenFull: true
			},
			// table: {
			// 	contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
			// },
			language: 'en'
		};
		
		ClassicEditor.create(document.querySelector('#content-editor'))
			.then(cEditor => {
				contentEditor = cEditor;
				contentEditor.model.document.on('change:data', () => {
					@this.set('content', contentEditor.getData());
				});
			})
			.catch(error => {
				console.error(error);
			});

		Livewire.on('setEditor', (content) => {
			contentEditor.setData(content[0]);
		});

	});
</script>