<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Tracks</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th><input type="checkbox" class="select-all"></th>
                <th>Track Name</th>
                <th>Length</th>
                <th>BPM</th>
                <th>Key</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><input type="checkbox" name="selected[]" class="page" value="<?php echo e($track->id); ?>"></td>
                <?php echo $__env->make('admin.tracks.partials.title', ['partial' => $track], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <td><?php echo e($track->length); ?></td>
                <td><?php echo e($track->bpm); ?></td>
                <td><?php echo e($track->key); ?></td>
                <td><?php echo e($track->price); ?></td>
                <td><?php echo e($track->status); ?></td>
                <td><?php echo e($track->created_at); ?></td>
                <td><?php echo e($track->updated_at); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phase\resources\views/admin/tracks/show.blade.php ENDPATH**/ ?>