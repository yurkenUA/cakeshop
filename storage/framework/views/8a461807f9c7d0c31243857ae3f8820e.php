<?php $__env->startSection('content'); ?>

<section class="is-relative section has-background-light">
  <div class="is-relative container">
    <div class="columns is-vcentered">
      <div class="column is-5 m-auto">
        <div class="box p-6 px-10-desktop py-12-desktop has-background-white has-text-centered">
          <form method="POST" action="<?php echo e(route('password.store')); ?>">
            <?php echo csrf_field(); ?>
            
            <h3 class="title has-text-danger is-4 mt-4 mb-12">Reset password</h3>
            <div class="is-relative mb-5">
              <input class="input py-5 has-background-white has-text-grey" type="email" placeholder="e.g hello@shuffle.dev">
              <span class="span-label ml-3 has-background-white">Your email address</span>
            </div>
            <div class="is-relative mb-5">
              <input class="input py-5 has-background-white has-text-grey" type="password" placeholder="******">
              <span class="span-label ml-3 has-background-white">Password</span>
            </div>        
            <div class="is-relative mb-5">
                <input class="input py-5 has-background-white has-text-grey" type="password" placeholder="******">
                <span class="span-label ml-3 has-background-white">Confirm Password</span>
            </div>          

            <div class="is-flex is-justify-content-end	mt-5 is-align-items-flex-end">
              <button class="button is-danger has-text-warning-light">Reset Password</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/auth/reset-password.blade.php ENDPATH**/ ?>