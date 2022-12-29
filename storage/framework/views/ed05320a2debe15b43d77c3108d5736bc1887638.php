

<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
        <?php if(!$user->approved_at): ?>
            <form action="<?php echo e(url()->current()); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="" style="text-align: center">
                    <input type="submit" class="btn btn-sm btn-success" value="Approve">
                </div>
            </form>
        <?php endif; ?>
    </div>

    <div>
        <form action="<?php echo e(url()->current()); ?>" method="post" enctype="multipart/form-data">
            <?php echo method_field('patch'); ?>
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="name">Display Name</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" required class="form-control" name="name" id="name" value="<?php echo e($user->name); ?>">
            </div>

            <div class="form-group">
                <label for="first_name">First Name</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'first_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" required class="form-control" name="first_name" id="first_name"
                       value="<?php echo e($user->first_name); ?>">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'last_name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" required class="form-control" name="last_name" id="last_name"
                       value="<?php echo e($user->last_name); ?>">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'phone'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" required class="form-control" name="phone" id="phone" value="<?php echo e($user->phone); ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'email'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" required class="form-control" name="email" id="email" value="<?php echo e($user->email); ?>">
            </div>

            <div class="form-group">
                <label for="social_web">Website</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'social_web'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" required class="form-control" name="social_web" id="social_web"
                       value="<?php echo e($user->social_web); ?>">
            </div>

            <div class="form-group">
                <label for="social_youtube">YouTube</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'social_youtube'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" required class="form-control" name="social_youtube" id="social_youtube"
                       value="<?php echo e($user->social_youtube); ?>">
            </div>

            <div class="form-group">
                <label for="social_twitter">Twitter</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'social_twitter'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" required class="form-control" name="social_twitter" id="social_twitter"
                       value="<?php echo e($user->social_twitter); ?>">
            </div>

            <div class="form-group">
                <label for="social_facebook">Facebook</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'social_facebook'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="text" required class="form-control" name="social_facebook" id="social_facebook"
                       value="<?php echo e($user->social_facebook); ?>">
            </div>

            <div class="form-group">
                <label for="interests">Interests</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'interests'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <select name="interests[]" id="interests" class="form-control" multiple="multiple">
                    <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e($user->interests->contains($interest->id) ? 'selected' : null); ?> value="<?php echo e($interest->id); ?>"><?php echo e($interest->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="genres">Genres</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'genres'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <select name="genres[]" id="genres" class="form-control" multiple="multiple">
                    <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e($user->genres->contains($genre->id) ? 'selected' : null); ?> value="<?php echo e($genre->id); ?>"><?php echo e($genre->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Role</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'role'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <select name="role" required id="role" class="form-control">
                    <option>Select a Role</option>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($role->id); ?>" <?php echo e($user->roles->contains('name', $role->name) ? 'selected' : null); ?>><?php echo e(ucfirst($role->name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'password'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Password Confirmation</label>
                <?php echo $__env->make('admin.partials.field-error', ['field' => 'password_confirmation'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>

            <input type="submit" class="btn btn-sm btn-outline-secondary" value="Update">
        </form>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
      jQuery(function ($) {
        $('#interests').select2()
        $('#genres').select2()
      })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\phase-app-laravel-vue\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>