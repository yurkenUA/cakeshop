<?php $__env->startSection('content'); ?>
<div class="level">
  <!-- Left side -->
  <div class="level-left">
    <h1><?php echo e(isset($size) ? "Change Size $size->size inches" : 'Create Size'); ?></h1>
  </div>

  <div class="level-right">
    <a href="<?php echo e(route('admin.sizes.index')); ?>" class="button is-info">Size List</a>
  </div>
</div>
<form action="<?php echo e(route('admin.sizes.save')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php if(isset($size)): ?>
    <input type="hidden" name="size_id" value="<?php echo e($size->id); ?>" />
    <?php endif; ?>

    <div class="columns">
      <div class="column is-one-quarter">
        <input class="input is-info" type="number" placeholder="Select Size" name="size" value="<?php echo e(old('size', isset($size) ? $size->size : '')); ?>"/>
        <?php $__errorArgs = ['size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <div class="has-text-danger mt-1"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
    </div>
    
    <button type="submit" class="button is-link is-rounded mr-6">Save</button>
    <a href="<?php echo e(route('admin.sizes.index')); ?>" class="button has-background-warning is-rounded">Go Back</a>


</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/admin/sizes/manage.blade.php ENDPATH**/ ?>