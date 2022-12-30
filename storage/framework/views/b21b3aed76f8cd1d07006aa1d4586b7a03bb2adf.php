<?php $__env->startSection('content'); ?>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<h1 class="h2">Edit Track</h1>
	</div>

	<div>
		<form action="<?php echo e(url()->current()); ?>" method="post" enctype="multipart/form-data">
			<?php echo method_field('patch'); ?>
			<?php echo csrf_field(); ?>

			<div class="form-group">
				<label for="name">Name</label>
				<?php echo $__env->make('admin.partials.field-error', ['field' => 'name'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<input type="text" class="form-control" name="name" id="name" value="<?php echo e($track->name); ?>">
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<?php echo $__env->make('admin.partials.field-error', ['field' => 'description'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<textarea class="form-control" name="description" id="description"><?php echo e($track->description); ?></textarea>
			</div>

			<div class="form-group">
				<label for="price">Release</label>
				<?php echo $__env->make('admin.partials.field-error', ['field' => 'release'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<a href="<?php echo e(url('releases/'. $track->release->id)); ?>"><?php echo e($track->release->name); ?></a>
			</div>

			<div class="form-group">
				<label for="price">Price</label>
				<?php echo $__env->make('admin.partials.field-error', ['field' => 'price'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<input type="number" class="form-control" name="price" id="price" value="<?php echo e($track->price); ?>">
			</div>

			<div class="form-group">
				<label for="length">Length</label>
				<?php echo $__env->make('admin.partials.field-error', ['field' => 'length'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<input type="text" class="form-control" name="length" id="length" value="<?php echo e($track->length); ?>">
			</div>

			<div class="form-group">
				<label for="bpm">BPM</label>
				<?php echo $__env->make('admin.partials.field-error', ['field' => 'bpm'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<input type="text" class="form-control" name="bpm" id="bpm" value="<?php echo e($track->bpm); ?>">
			</div>

			<div class="form-group">
				<label for="key">Key</label>
				<?php echo $__env->make('admin.partials.field-error', ['field' => 'key'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<input type="text" class="form-control" name="key" id="key" value="<?php echo e($track->key); ?>">
			</div>

			<div class="form-group">
				<label for="uploaded-by">Uploaded By</label>
				<?php echo $__env->make('admin.partials.field-error', ['field' => 'uploaded_by'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<input type="text" disabled class="form-control" name="uploaded-by" id="uploaded-by" value="<?php echo e($track->artist->name); ?>">
			</div>

			<div class="form-group">
				<label for="genres">Genres</label>
				<?php echo $__env->make('admin.partials.field-error', ['field' => 'genres'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<genre-select :populated="<?php echo e($track->genres); ?>"></genre-select>
			</div>

			<input type="submit" class="btn btn-sm btn-outline-secondary" value="Update">
			<?php
			if(isset( $track->streamable->files) )
			{
				$trackPath = $track->streamable->files->first()->url;
			}else{
				$trackPath = null;
			}
			?>
			<?php if($trackPath !== null): ?>
				<audio src="<?php echo e($trackPath); ?>" controls="controls" preload="none" style="padding-top:10px;">
					Your browser does not support the <code>audio</code> element.
				</audio>
			<?php endif; ?>
		</form>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\phase\resources\views/admin/tracks/edit.blade.php ENDPATH**/ ?>