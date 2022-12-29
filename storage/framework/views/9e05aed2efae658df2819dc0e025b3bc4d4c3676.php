<div class="filter-bar">
	<ul class="filters">
		<li>
			<a href="<?php echo e(url('admin/users')); ?>">All</a> <span class="count">(<?php echo e(App\User::count()); ?>)</span>
		</li>

		<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if(($count = App\User::role($role->name)->count()) > 0): ?>
				<li>
					<a href="<?php echo e(url("admin/users/role/{$role->name}")); ?>"><?php echo e(ucfirst($role->name)); ?></a> <span class="count">(<?php echo e($count); ?>)</span>
				</li>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		<?php if(($count = App\User::onlyTrashed()->count()) > 0): ?>
			<li>
				<a href="<?php echo e(url('admin/users/trashed')); ?>">Trashed</a> <span class="count">(<?php echo e($count); ?>)</span>
			</li>
		<?php endif; ?>
	</ul>

	<?php echo $__env->make('admin.partials.bulk-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH D:\phase-app-laravel-vue\resources\views/admin/users/partials/filters.blade.php ENDPATH**/ ?>