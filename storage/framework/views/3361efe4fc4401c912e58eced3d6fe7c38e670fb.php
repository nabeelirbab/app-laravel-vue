<td class="has-actions">
	<?php if($filter == 'trashed'): ?>
		<?php echo e(\Illuminate\Support\Str::limit($partial->name, 30)); ?>

	<?php else: ?>
		<a href="<?php echo e(url('/admin/users/edit/' . $partial->id)); ?>"><?php echo e(\Illuminate\Support\Str::limit($partial->name, 30)); ?></a>
	<?php endif; ?>

	<div class="row-actions">
		<?php if($filter != 'trashed'): ?>
			<span class="view">
				<a href="<?php echo e(url('/user/' . $partial->path)); ?>">View</a>
			</span>
		|
			<span class="edit">
				<a href="<?php echo e(url('/admin/users/edit/' . $partial->id)); ?>">Edit</a>
            </span>
		<?php endif; ?>

		<?php if(Auth::id() != $partial->id): ?>
			|

			<?php if($filter == 'trashed'): ?>
				<span class="restore">
					<a href="<?php echo e(url('/admin/users/restore/' . $partial->id)); ?>">Restore</a>
				</span>
				|
				<span class="bin">
					<a href="<?php echo e(url('/admin/users/destroy/' . $partial->id)); ?>">Delete</a>
				</span>
            <?php else: ?>
                <span>
                    <?php if($user->status == 'active'): ?>
                        <a href="<?php echo e(url('/admin/users/freeze/' . $partial->id)); ?>">Freeze</a>
                    <?php else: ?>
                        <a href="<?php echo e(url('/admin/users/activate/' . $partial->id)); ?>">Activate</a>
                    <?php endif; ?>

                </span>
				|
				<span class="bin">
					<a href="<?php echo e(url('/admin/users/ban/' . $partial->id)); ?>">Ban</a>
				</span>
                |
				<span class="bin">
					<a href="<?php echo e(url('/admin/users/delete/' . $partial->id)); ?>">Bin</a>
                </span>
            <?php endif; ?>
            | 
            
            <?php if(!$partial->approved_at): ?>
            	<a class="text-primary" title="Verify" href="<?php echo e(url('/admin/users/approve/' . $partial->id)); ?>">
            		<i class=' fa fa-check-circle'></i>
            	</a>
            <?php else: ?>
            	<a class="text-danger" title="Unverify" href="<?php echo e(url('/admin/users/unapprove/' . $partial->id)); ?>">
            		<i class=" fa fa-times-circle"></i>
            	</a>
            <?php endif; ?>
		<?php endif; ?>
	</div>
</td>
<?php /**PATH C:\xampp\htdocs\phase\resources\views/admin/users/partials/title.blade.php ENDPATH**/ ?>