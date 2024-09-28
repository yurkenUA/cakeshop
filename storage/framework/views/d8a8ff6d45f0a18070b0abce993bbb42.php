<?php $__env->startSection('content'); ?>

<section class="is-relative section has-background-light">
    <div class="is-relative container">
      <div class="columns is-vcentered">
        <div class="column is-5 m-auto">
          <div class="box p-6 px-10-desktop py-12-desktop has-background-white has-text-centered">
            <form method="POST" action="<?php echo e(route('verification.send')); ?>">
                <?php echo csrf_field(); ?>

              <h3 class="title has-text-danger is-4 mt-4 mb-12">Email verification</h3>
              <p class="has-text-weight-medium	is-size-6">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
              <?php if(session('status')): ?>
                <div class="has-text-success mt-1"><?php echo e(session('status')); ?></div>
              <?php endif; ?>
              <div class="is-flex is-justify-content-space-between	mt-5 is-align-items-flex-end">
                <button class="button is-danger has-text-warning-light">Resend Verification Email</button>
                <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="<?php echo e(route('home')); ?>">Back home</a></span>
                <span class="is-inline-block  mr-5"><a class="dark-pink" href="#">Log out</a></span>
                
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/auth/verify-email.blade.php ENDPATH**/ ?>