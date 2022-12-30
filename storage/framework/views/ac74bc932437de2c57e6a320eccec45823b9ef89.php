<td class="has-actions">
	<a href="<?php echo e(url('/admin/tracks/edit/'.$partial->id)); ?>"><?php echo e($partial->name); ?></a>
	<div class="row-actions">
		<span class="view">
			<a href="<?php echo e(url('/track/' . $partial->slug)); ?>">View</a>
		</span>
		|
		<?php if (! ($partial->approved())): ?>
		<span class="approve">
			<a href="<?php echo e(url('/admin/tracks/approve/' . $partial->id)); ?>">Approve</a>
		</span>
		|
		<?php endif; ?>
		<span class="edit">
			<a href="<?php echo e(url('/admin/tracks/freeze/' . $partial->id)); ?>">Freeze</a>
		</span>
		|
		<span class="bin">
			<a href="<?php echo e(url('/admin/tracks/destroy/' . $partial->id)); ?>">Delete</a>
		</span>
	</div>
</td>
<?php /**PATH C:\xampp\htdocs\phase\resources\views/admin/tracks/partials/title.blade.php ENDPATH**/ ?>