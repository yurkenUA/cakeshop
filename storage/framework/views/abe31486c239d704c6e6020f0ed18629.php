<?php $__env->startSection('content'); ?>
<div class="level">
  <!-- Left side -->
  <div class="level-left">
    <h1>Products List</h1>
  </div>

  <div class="level-right">
    <a href="<?php echo e(route('admin.products.create')); ?>" class="button is-info">Create Product</a>
  </div>
</div>

<?php echo $__env->make('admin.products.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.helpers.confirm-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/admin/products/index.blade.php ENDPATH**/ ?>