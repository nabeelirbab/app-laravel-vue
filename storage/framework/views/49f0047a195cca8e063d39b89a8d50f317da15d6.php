<ul class="filters">
	<li>
		<select name="actions" id="actions" class="form-control">
			<option value="">Bulk Actions</option>
			<?php if($filter != 'trashed'): ?>
				<option value="bin">Move to Bin</option>
			<?php endif; ?>
			<?php if(Request::is('admin/news/*')): ?>
				<option value="publish">Publish Post</option>
			<?php endif; ?>
			<?php if($filter == 'trashed'): ?>
				<?php if(isset($forcedelete) && $forcedelete == 1): ?>
					<option value="forceDelete">Delete</option>
				<?php endif; ?>
				<option value="restore">Restore</option>
			<?php endif; ?>
		</select>
	</li>

	<li>
		<input type="submit" value="Apply" class="btn btn-outline-secondary">
	</li>
</ul>
<?php /**PATH D:\phase-app-laravel-vue\resources\views/admin/partials/bulk-actions.blade.php ENDPATH**/ ?>