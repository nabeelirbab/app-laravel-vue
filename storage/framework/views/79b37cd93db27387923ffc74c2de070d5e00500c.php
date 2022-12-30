<?php $__env->startSection('content'); ?>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Releases <small><?php echo e($filter); ?></small></h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<a href="<?php echo e(url('admin/releases/create')); ?>" class="btn btn-sm btn-outline-secondary">New Release</a>
			</div>
		</div>
	</div>

	<form action="<?php echo e(url()->current()); ?>" method="post">
		<?php echo csrf_field(); ?>

		<?php echo $__env->make('admin.releases.partials.filters', ['filter' => $filter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th><input type="checkbox" class="select-all"></th>
						<th>Title</th>
						<th></th>
						<th>Status</th>
						<th>Total Tracks</th>
						<th>Featured</th>
						<th>Release Date</th>
						<th>Royalty Fee</th>
						<th>Updated</th>
						<th>Created</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $releases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $release): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><input type="checkbox" name="selected[]" class="page" value="<?php echo e($release->id); ?>"></td>
							<?php echo $__env->make('admin.releases.partials.title', ['partial' => $release], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<td><a href="/admin/tracks/release/<?php echo e($release->id); ?>" class="btn btn-secondary">View Tracks</a></td>
							<td><?php echo e($release->status); ?></td>
							<td><?php echo e($release->tracks->count()); ?></td>
							<td><?php if($release->isFeatured()): ?> Yes <?php else: ?> No <?php endif; ?></td>
							<td><?php echo e($release->release_date->format('d/m/Y')); ?></td>
							<td><?php echo e($release->royalty_fee); ?>%</td>
							<td><?php echo e($release->updated_at); ?></td>
							<td><?php echo e($release->created_at); ?></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</form>

	<?php echo e($releases->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phase\resources\views/admin/releases/index.blade.php ENDPATH**/ ?>