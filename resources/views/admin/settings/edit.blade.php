@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h1 class="h2">Settings</h1>
</div>

<div>
	<form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
		@method('patch')
		@csrf

		<div class="form-group">
			<label for="title">Site Title</label>
			<small><em>
				Global site title
			</em></small>
			@include('admin.partials.field-error', ['field' => 'title'])
			<input type="text" class="form-control" name="title" id="title"
			value="{{ $settings->has('title') ? $settings->get('title')->value : null }}"
			>
		</div>

		<div class="form-group">
			<label for="logo_title">Logo Title</label>
			<small><em>
				Text displayed under logo in header
			</em></small>
			@include('admin.partials.field-error', ['field' => 'logo_title'])
			<input type="text" class="form-control" name="logo_title" id="logo_title"
			value="{{ $settings->has('logo_title') ? $settings->get('logo_title')->value : null }}"
			>
		</div>

		<div class="form-group">
			<label for="admin_email">Admin Email Address</label>
			<small><em>
				Main administrator email address. All system notifications and important mail are sent to this
				address
			</em></small>
			@include('admin.partials.field-error', ['field' => 'admin_email'])
			<input type="email" class="form-control" name="admin_email" id="admin_email"
			value="{{ $settings->has('admin_email') ? $settings->get('admin_email')->value : null }}"
			>
		</div>

		<div class="form-group">
			<label for="wav_fee">WAV Fee</label>
			<small><em>
				Additional fee (in pennies) for purchasing a WAV file. Applied per track, so if a user purchases a
				WAV release with 4 tracks, the fee will be applied 4 times.
			</em></small>
			@include('admin.partials.field-error', ['field' => 'wav_fee'])
			<input type="number" class="form-control" name="wav_fee" id="wav_fee"
			value="{{ $settings->has('wav_fee') ? $settings->get('wav_fee')->value : null }}"
			>
		</div>

		<div class="form-group">
			<label for="tax_rate">Tax Rate</label>
			<small><em>
				Tax applied to every transaction, expressed as a percentage (e.g. 0.2 = 20%)
			</em></small>
			@include('admin.partials.field-error', ['field' => 'tax_rate'])
			<input type="number" step="0.0001" class="form-control" name="tax_rate" id="tax_rate"
			value="{{ $settings->has('tax_rate') ? $settings->get('tax_rate')->value : null }}"
			>
		</div>

		<div class="form-group">
			<label for="purchase_approval_threshold">Purchase Approval Threshold</label>
			<small><em>
				Purchases totaling this value (in pennies) or greater must be approved by an admin.
			</em></small>
			@include('admin.partials.field-error', ['field' => 'purchase_approval_threshold'])
			<input type="number" class="form-control" name="purchase_approval_threshold" id="purchase_approval_threshold"
			value="{{ $settings->has('purchase_approval_threshold') ? $settings->get('purchase_approval_threshold')->value : null }}"
			>
		</div>

		<div class="form-group">
			<label for="banned_words">Banned Words</label>
			<small><em>
				Comma separated list of words which should be replaced with asterisks in text submitted by users
			</em></small>
			@include('admin.partials.field-error', ['field' => 'banned_words'])
			<textarea class="form-control" name="banned_words" id="banned_words" rows="4">{{ $settings->has('banned_words') ? $settings->get('banned_words')->value : null }}</textarea>
		</div>

		<div class="form-group">
			<label for="featured_spot_price">Featured Spot Price</label>
			<small><em>
				The price per day for a featured spot.
			</em></small>
			@include('admin.partials.field-error', ['field' => 'featured_spot_price'])
			<input type="number" class="form-control" name="featured_spot_price" id="featured_spot_price"
			value="{{ $settings->has('featured_spot_price') ? $settings->get('featured_spot_price')->value : null }}">
		</div>

		<div class="form-group ">
			<label for="featured_spot_price">Single Track Price Range</label>
			<small><em>
				Define the Range of price for single track
			</em></small>
			<div class="row">
				<div class="col-sm-5">
					@include('admin.partials.field-error', ['field' => 'single_track_price_from'])
					<input id="single_track_price_from" class="form-control input-group-lg " type="number" value="{{ $settings->has('single_track_price_from') ? $settings->get('single_track_price_from')->value : 50 }}" name="single_track_price_from" title="Enter from price" placeholder="From" step=".01">
				</div>
				<div class="col-sm-1"><label>-</label></div>       
				<div class="col-sm-5">
					@include('admin.partials.field-error', ['field' => 'single_track_price_to'])
					<input id="single_track_price_to" class="form-control input-group-lg " type="number" value="{{ $settings->has('single_track_price_to') ? $settings->get('single_track_price_to')->value : 300 }}" name="single_track_price_to" title="Enter to price" placeholder="To" step=".01">
				</div>
			</div>

		</div>

		<div class="form-group ">
			<label for="featured_spot_price">Album Price Range</label>
			<small><em>
				Define the Range of price for album
			</em></small>
			<div class="row">
				<div class="col-sm-5">
					@include('admin.partials.field-error', ['field' => 'album_price_from'])
					<input id="album_price_from" class="form-control input-group-lg " type="number" value="{{ $settings->has('album_price_from') ? $settings->get('album_price_from')->value : 300 }}" name="album_price_from" title="Enter from price" placeholder="From" step=".01">
				</div>
				<div class="col-sm-1"><label>-</label></div>       
				<div class="col-sm-5">
					@include('admin.partials.field-error', ['field' => 'album_price_to'])
					<input id="album_price_to" class="form-control input-group-lg " type="number" value="{{ $settings->has('album_price_to') ? $settings->get('album_price_to')->value : 3000 }}" name="album_price_to" title="Enter to price" placeholder="To" step=".01">
				</div>
			</div>
			
		</div>

		<input type="submit" class="btn btn-sm btn-outline-secondary" value="Update">
	</form>
</div>
@endsection