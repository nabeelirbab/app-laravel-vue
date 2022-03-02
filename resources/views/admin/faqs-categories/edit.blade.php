@extends('admin.layout')

@section('content')
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Edit FAQ Category</h1>
	</div>

	<div>
		<form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
					@method('patch')
			@csrf

			<div class="form-group">
				<label for="category">Category Name</label>
				@include('admin.partials.field-error', ['field' => 'category'])
				<input type="text" class="form-control" name="category" id="category" required value="{{$categories->name}}">
			</div>

			<div class="form-group">
				<label for="category-icon">Category Icon</label>
				@include('admin.partials.field-error', ['field' => 'category-icon'])
				<!-- <input type="text" class="form-control" name="category-icon" id="category-icon" value="{{$categories->icon}}"> -->
				<div class="row">
					<div class="col-sm-9">
						<select class="form-control" name="category-icon" id="category-icon">
							@foreach($allIcons as $icon) 
								<option value="{{$icon}}" 
								@if($icon == $categories->icon) selected @endif
								><i class="{{ $icon }}" aria-hidden="true"></i> {{ $icon }} </option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-3">
						<div id="icon-view-div"><i class="{{ $categories->icon }} fa-1.5x" ></i></div>
					</div>
				</div>
				

				
			</div>

			<div class="form-group">
				<label for="sort_id">Sort ID</label>
				@include('admin.partials.field-error', ['field' => 'sort_id'])
				<input type="number" class="form-control" name="sort_id" id="sort_id" value="{{$categories->sort_id}}">
			</div>

			<input type="submit" class="btn btn-sm btn-outline-secondary" value="Update">
		</form>
	</div>

@push('scripts')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<script>
		jQuery(function ($) {
			$('#category-icon').select2();

			
			$('#category-icon').on("change", function() {
				var icon = $(this).val();
				$("#icon-view-div").html("<i class='"+icon+" fa-1.5x' ></i>");
			})
		})
</script>
@endpush
@endsection
