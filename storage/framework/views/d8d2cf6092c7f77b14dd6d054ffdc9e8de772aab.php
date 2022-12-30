<div class="filter-bar">
	<ul class="filters">
		<li>
			<a href="<?php echo e(url('admin/releases')); ?>">All</a> <span class="count">(<?php echo e(App\Release::count()); ?>)</span>
		</li>

		<li>
			<a href="<?php echo e(url('admin/releases/live')); ?>">Live</a> <span class="count">(<?php echo e(App\Release::statusLive()->count()); ?>)</span>
		</li>

		<li>
			<a href="<?php echo e(url('admin/releases/featured')); ?>">Featured</a> <span class="count">(<?php echo e(App\Release::featured()->count()); ?>)</span>
		</li>

		<li>
			<a href="<?php echo e(url('admin/releases/pending')); ?>">Pending</a> <span class="count">(<?php echo e(App\Release::statusPending()->count()); ?>)</span>
		</li>

		<li>
			<a href="<?php echo e(url('admin/releases/offline')); ?>">Offline</a> <span class="count">(<?php echo e(App\Release::statusOffline()->count()); ?>)</span>
		</li>

		<li>
			<a href="<?php echo e(url('admin/releases/trashed')); ?>">Trashed</a> <span class="count">(<?php echo e(App\Release::onlyTrashed()->count()); ?>)</span>
		</li>
	</ul>

	<?php echo $__env->make('admin.partials.bulk-actions', ['forcedelete' => 1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\phase\resources\views/admin/releases/partials/filters.blade.php ENDPATH**/ ?>