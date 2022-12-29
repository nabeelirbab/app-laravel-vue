<?php $__env->startSection('content'); ?>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Users <small><?php echo e($filter); ?></small></h1>
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				<a href="<?php echo e(url('admin/users/create')); ?>" class="btn btn-sm btn-outline-secondary">New User</a>
			</div>
		</div>
	</div>

	<form action="<?php echo e(url()->current()); ?>" method="post">
		<?php echo csrf_field(); ?>

		<?php echo $__env->make('admin.users.partials.filters', ['filter' => $filter], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<div class="table-responsive">
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th><input type="checkbox" class="select-all"></th>
						<th>Display Name</th>
						<th>Email</th>
                        <th>Roles</th>
                        <th>Status</th>
						<th>Approved At</th>
						<th>Created</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><input type="checkbox" name="selected[]" class="page" value="<?php echo e($user->id); ?>"></td>
							<?php echo $__env->make('admin.users.partials.title', ['partial' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							<td><?php echo e($user->email); ?></td>
                            <td><?php echo implode(',', array_map('ucfirst', $user->roles->pluck('name')->toArray())); ?></td>
                            <td><?php echo e($user->status); ?></td>
							<td>
								<?php if(!$user->approved_at): ?> <p class="btn-danger p-2">Requires Approval</p>
								<?php else: ?> <?php echo e($user->approved_at); ?>

								<?php endif; ?>
							</td>
							<td><?php echo e($user->created_at); ?></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</form>

	<?php echo e($users->links()); ?>


	<?php $__env->startPush("styles"); ?>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' />
	<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phase\resources\views/admin/users/index.blade.php ENDPATH**/ ?>