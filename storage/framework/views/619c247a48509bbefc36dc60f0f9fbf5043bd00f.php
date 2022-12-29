

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h1 class="h2">Dashboard</h1>
	<div class="btn-toolbar mb-2 mb-md-0">








	</div>
</div>



<div>
	<h3>New Users</h3>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Role</th>
				</tr>
			</thead>
			<tbody>
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<?php echo $__env->make('admin.users.partials.title', ['partial' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<td><?php echo e($user->email); ?></td>
					<td><?php echo implode(',', array_map('ucfirst', $user->roles->pluck('name')->toArray())); ?></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
</div>

<div>
	<h3>New Releases</h3>
	<form action="<?php echo e(url()->current()); ?>" method="post">
		<?php echo csrf_field(); ?>



		<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr>

						<th>Title</th>
						<th></th>
						<th>Status</th>
						
						<th>Featured</th>
						<th>Release Date</th>
						
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $releases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $release): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>

							<?php echo $__env->make('admin.releases.partials.title', ['partial' => $release], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<td><a href="release/<?php echo e($release->slug); ?>" class="btn btn-secondary">View Tracks</a></td>
							<td><?php echo e($release->status); ?></td>
							
							<td><?php if($release->isFeatured()): ?> Yes <?php else: ?> No <?php endif; ?></td>
							<td><?php echo e($release->release_date); ?></td>
						
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</form>

	<?php echo e($releases->links()); ?>

</div>

































































































































<?php $__env->stopSection(); ?>


































<?php $__env->startPush("styles"); ?>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' />
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\phase-app-laravel-vue\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>