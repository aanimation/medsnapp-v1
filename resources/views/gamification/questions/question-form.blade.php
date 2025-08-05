<div class="card card-body bg-transparent border{{$keyToEdit ? '' : '-warning'}}">
	<div class="container-fluid py-md-2 px-sm-0">
		
		<div class="row">
			<h5>Question Form</h5>
			
			<div class="col-12 h-30">
				<label>Clinical Vignette</label>
				@error('clinical')
					<span class="text-xs text-warning">{{ $message }}</span>
				@enderror
				<div wire:ignore class="input-group input-group-static mb-4">
					<textarea id="clinical-editor" wire:model.defer="clinical" rows="2" class="rich-text form-control @error('clinical')is-invalid @enderror"></textarea>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="input-group input-group-static p-1 mb-4">
					<label>Question</label>
					<textarea wire:model.blur="question" rows="2" class="form-control @error('question')is-invalid @enderror"></textarea>
					@error('question')
						<span class="text-xs text-warning">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="input-group input-group-static mb-4">
					<label>Category</label>
					<select wire:model="category_id" class="form-control mt-4">
						<option value="">select category</option>
						@foreach($categories as $item)
						<option value="{{ $item->id }}" @if($item->id == $category_id)selected @endif>{{ $item->name }}</option>
						@endforeach
					</select>
					@error('category_id')
						<span class="text-xs text-warning">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="col-12 col-lg-6">
				&nbsp;
			</div>
			<div class="col-12">
				<div class="row"> 
				@foreach($answers as $idx => $answer)
				<div class="col-lg-6 col-12">
					<div class="d-flex">
						<div class="input-group input-group-static w-lg-90 w-sm-100">
							<label class="text-sm">Answer {{$answerLabels[$idx]}}</label>
							<textarea wire:model.blur="answers.{{$idx}}.text" rows="1" class="form-control @error('answers.'.$idx.'.text')is-invalid @enderror"></textarea>
							@error('answers.'.$idx.'.text')
								<span class="text-xs text-warning">{{ $message }}</span>
							@enderror
						</div>
						<div class="input-group input-group-static w-lg-10 w-sm-40">
							<label class="text-xs mt-sm-2">Correct</label>
							<div wire:key="answer-{{$loop->index}}" class="form-check pt-lg-3 ps-sm-2">
							  	<input value="{{ $loop->index }}" wire:model.live="answer" class="form-check-input" type="radio" id="answer{{$loop->index}}" name="answer-{{$loop->index}}">  
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="input-group input-group-static p-1 mt-sm-4 mb-4" style="border: thin solid #9C27B0; border-radius: 5px;">
						<label class="text-xs">Explanation</label>
						<textarea wire:model.blur="answers.{{$idx}}.note" rows="4" class="form-control borderless @error('answers.'.$idx.'.note')is-invalid @enderror"></textarea>
						@error('answers.'.$idx.'.note')
							<span class="text-xs text-warning">{{ $message }}</span>
						@enderror
					</div>
				</div>
				@endforeach
			</div>

			<div class="col-lg-9 col-12">
				<label>Search</label>
				@error('description')
					<span class="text-xs text-warning">{{ $message }}</span>
				@enderror
				<div class="input-group input-group-outline mb-4">
					<input wire:model.defer="description" class="form-control text-white">
				</div>

				<label>Topic</label>
				@error('topic')
					<span class="text-xs text-warning">{{ $message }}</span>
				@enderror
				<div class="input-group input-group-outline mb-4">
					<input wire:model.defer="topic" class="form-control text-white">
				</div>
			</div>

			<div class="col-12">
				<label>Topic Description</label>
				@error('explanation')
					<span class="text-xs text-warning">{{ $message }}</span>
				@enderror
				<div wire:ignore class="input-group input-group-static mb-4">
					<textarea id="explain-editor" wire:model.defer="explanation" rows="2" class="rich-text form-control @error('explanation')is-invalid @enderror"></textarea>
				</div>
			</div>
		</div> <!-- end row -->
		<div class="text-center">
			<a href="{{ route('question-list') }}" class="btn bg-secondary text-white font-weight-bolder w-lg-20 mb-0 {{ $isAdmin ? '' : 'd-none'}}">Back</a>
			<button type="button" wire:click="resetForm" class="btn bg-secondary text-white font-weight-bolder w-lg-20 mb-0 {{ !$isAdmin && $keyToEdit ? '' : 'd-none'}}">Cancel</button>
			<button type="submit" wire:click.prevent="submit('draft')" class="btn bg-secondary text-white font-weight-bolder w-sm-50 w-lg-20 mb-0">{{$keyToEdit ? 'Save' : 'Save as'}} draft</button>
			<button type="button" wire:click="preview" class="btn bg-secondary text-dark font-weight-normal w-lg-10 mb-0">Preview</button> 
			<button title="Publish" type="submit" wire:click.prevent="submit('published')" class="btn bg-gradient-medsnapp text-white font-weight-bolder w-sm-60 w-lg-20 mb-0 mt-sm-4">Publish</button>
			@error('answer')
				<span class="text-sm text-warning ms-3">{{ $message }}</span>
			@enderror
		</div>

		@livewire('question.question-modal')

	</div> <!-- end container -->
</div>

<style type="text/css">
	.ck.ck-editor__main>.ck-editor__editable {
		background: #131828;
		min-height: 200px;
		min-width: 800px;
	}

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

<!-- https://ckeditor.com/docs/ckeditor5/latest/getting-started/installation/laravel.html -->
<script src="/assets/js/plugins/ckeditor.js"></script>
<script>
	document.addEventListener('livewire:initialized', () => {
		var editor1;
		var editor2;

		ClassicEditor.defaultConfig = {
			toolbar: {
				items: ['undo','redo','heading',
					'|','bold','italic',
					//'strikethrough','subscript','superscript','code',
					// '|','alignment','fontsize','fontColor','fontBackgroundColor',
					'|','bulletedList','numberedList',
					//'outdent', 'indent',
					'|','insertTable','link',
				],
				// shouldNotGroupWhenFull: true
			},
			// table: {
			// 	contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
			// },
			language: 'en'
		};
		
		ClassicEditor.create(document.querySelector('#clinical-editor'))
			.then(clinicalEditor => {
				editor1 = clinicalEditor;
				editor1.model.document.on('change:data', () => {
					@this.set('clinical', editor1.getData());
				});
			})
			.catch(error => {
				console.error(error);
			});

		Livewire.on('setEditor', (content) => {
			editor1.setData(content[0]);
		});


		ClassicEditor.create(document.querySelector('#explain-editor'))
			.then(explainEditor => {
				editor2 = explainEditor;
				editor2.model.document.on('change:data', () => {
					@this.set('explanation', editor2.getData());
				});
			})
			.catch(error => {
				console.error(error);
			});

		Livewire.on('setExplainEditor', (content) => {
			editor2.setData(content[0]);
		});

		Livewire.on('resetEditor', () => {
			editor1.setData('');
			editor2.setData('');
		});
	})

</script>
