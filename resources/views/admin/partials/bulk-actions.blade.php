<ul class="filters">
	<li>
		<select name="actions" id="actions" class="form-control">
			<option value="">Bulk Actions</option>
			@if ($filter != 'trashed')
				<option value="bin">Move to Bin</option>
			@endif
			@if (Request::is('admin/news/*'))
				<option value="publish">Publish Post</option>
			@endif
			@if ($filter == 'trashed')
				@if(isset($forcedelete) && $forcedelete == 1)
					<option value="forceDelete">Delete</option>
				@endif
				<option value="restore">Restore</option>
			@endif
		</select>
	</li>

	<li>
		<input type="submit" value="Apply" class="btn btn-outline-secondary">
	</li>
</ul>
