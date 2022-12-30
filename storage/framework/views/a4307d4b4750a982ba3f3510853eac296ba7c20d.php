<td class="has-actions">
	<?php if($filter == 'trashed'): ?>
		<?php echo e(\Illuminate\Support\Str::limit($partial->name, 30)); ?>

	<?php else: ?>
		<a href="<?php echo e(url('/admin/releases/edit/' . $partial->id)); ?>"><?php echo e(\Illuminate\Support\Str::limit($partial->name, 30)); ?></a>
	<?php endif; ?>

	<div class="row-actions">
		<?php if($filter != 'trashed'): ?>
			<span class="view">
				<a href="<?php echo e(url('/release/' . $partial->slug)); ?>">View</a>
			</span>
			<?php if($filter == 'live' || $partial->status == 'live'): ?>
				<span class="take-offline">
				<a href="<?php echo e(url('/admin/releases/take-offline/' . $partial->id)); ?>">Take Offline</a>
			</span>
			<?php elseif($filter == 'pending' || $partial->status == 'pending'): ?>
				<span class="approve">
				<a href="<?php echo e(url('/admin/releases/approve/' . $partial->id)); ?>">Approve</a>
			</span>
			<?php elseif($filter == 'offline' || $partial->status == 'offline'): ?>
				<span class="put-online">
				<a href="<?php echo e(url('/admin/releases/make-live/' . $partial->id)); ?>">Make Live</a>
			</span>
			<?php endif; ?>
			<span class="bin">
			<a href="<?php echo e(url('/admin/releases/delete/' . $partial->id)); ?>">Bin</a>
		</span>
		<?php endif; ?>
		<?php if($filter == 'trashed'): ?>
			<span class="restore">
				<a href="<?php echo e(url('/admin/releases/restore/' . $partial->id)); ?>">Restore</a>
			</span>
			|
			<span class="bin">
				<a href="<?php echo e(url('/admin/releases/destroy/' . $partial->id)); ?>">Delete</a>
			</span>
		<?php endif; ?>
	</div>
</td>
<?php /**PATH D:\phase-app-laravel-vue\resources\views/admin/releases/partials/title.blade.php ENDPATH**/ ?>