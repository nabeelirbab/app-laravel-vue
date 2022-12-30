

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Release</h1>
    </div>

    <div>
        <form action="<?php echo e(url()->current()); ?>" method="post" enctype="multipart/form-data">
            <?php echo method_field('patch'); ?>
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="name">Name</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo e($release->name); ?>">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <textarea class="form-control" name="description"
                          id="description"><?php echo e($release->description); ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'price'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="number" class="form-control" name="price" id="price" value="<?php echo e($release->price); ?>">
            </div>

            <div class="form-group">
                <label for="class">Class</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'class'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <select name="class" id="class" class="form-control" >
                    <?php $__currentLoopData = $allClass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e(( $key == $release->class ) ? 'selected' : null); ?> value="<?php echo e($key); ?>"><?php echo e($class); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="royalty_fee">Royalty Fee (%)</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'royalty_fee'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="number" min="0" class="form-control" name="royalty_fee" id="class"
                       value="<?php echo e($release->royalty_fee); ?>">
            </div>

            <div class="form-group">
                <label for="release-date">Release Date</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'release_date'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="date" class="form-control" name="release_date" id="release-date"
                       value="<?php echo e(date('Y-m-d', strtotime($release->release_date))); ?>">
            </div>

            <div class="form-group">
                <label for="uploaded-by">Uploaded By</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'uploaded_by'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" disabled class="form-control" name="uploaded-by" id="uploaded-by"
                       value="<?php echo e($release->uploader->name); ?>">
            </div>
            <div class="form-group">
                <label for="genres">Genres</label>
                <select name="genres[]" id="genres" class="form-control" multiple="multiple">
                    <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e($release->genres->contains($genre->id) ? 'selected' : null); ?> value="<?php echo e($genre->id); ?>"><?php echo e($genre->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tracks">Tracks</label>
                <ul>
                    <?php $__currentLoopData = $release->tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($track->streamable->files)): ?>
                            <?php ($trackPath = $track->streamable->files->first()->url); ?>
                        <?php else: ?>
                            <?php ($trackPath = null); ?>
                        <?php endif; ?>
                        <li><?php echo e($track->name); ?> <br> <?php if($trackPath !== null): ?>
                            <audio src="<?php echo e($trackPath); ?>" controls="controls" preload="none" style="padding-top:10px;">
                                Your browser does not support the <code>audio</code> element.
                            </audio>
                        <?php endif; ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            
            
            
            
            
            
            
            
            
            

            <?php if($release->isFeatured()): ?>
                <div class="form-group">
                    <label for="featured_dates">Featured Dates</label>
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <td>Date</td>
                            <td>Approved</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $release->featuredDates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($date->featured_date); ?></td>
                            <td><?php echo e($date->approved_at ? 'Yes' : 'No'); ?></td>
                            <td>
                                <a href="/admin/releases/featured-date/<?php echo e($date->id); ?>/approve">Approve</a>
                                <a href="/admin/releases/featured-date/<?php echo e($date->id); ?>/decline">Decline</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <input type="submit" class="btn btn-sm btn-outline-secondary" value="Update">
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
      jQuery(function ($) {
        $('#genres').select2()
      })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phase\resources\views/admin/releases/edit.blade.php ENDPATH**/ ?>