<td class="has-actions">
	{{ $partial->id }}

	<div class="row-actions">
		<span class="edit">
			<a href="{{ url('/admin/faqs-categories/edit/' . $partial->id) }}">Edit</a>
		</span>
		|
		<span class="bin">
			<a 
				@if($partial->faqs_count > 0) 
				class="disabled-btn"
				disabled title="This category contains {{$partial->faqs_count}} faqs"
				@else
				href="{{ url('/admin/faqs-categories/delete/' . $partial->id) }}"
				@endif
				>Delete</a>
			
		</span>
	</div>
</td>
@push('scripts')
<style>
	.disabled-btn {
		cursor: not-allowed;
        opacity: 0.6;
	}
</style>
@endpush