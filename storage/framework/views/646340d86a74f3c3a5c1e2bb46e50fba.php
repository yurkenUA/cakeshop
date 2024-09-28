<?php $__env->startSection('content'); ?>

<section class="is-relative section has-background-light">
  <div class="is-relative container">
    <div class="columns is-vcentered">
      <div class="column is-5 m-auto">
        <div class="box p-6 px-10-desktop py-12-desktop has-background-white has-text-centered">
          <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            
            <h3 class="title has-text-danger is-4 mt-4 mb-12">Log in</h3>

            <div class="is-relative mb-6">
              <input class="input py-5 has-background-white has-text-grey" type="email" placeholder="e.g hello@shuffle.dev" value="<?php echo e(old('email', '')); ?>" name="email">
              <span class="span-label ml-3 has-background-white">Your email address</span>
              <?php $__errorArgs = ['email'];
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
            <div class="is-relative mb-3">
              <input class="input py-5 has-background-white has-text-grey" type="password" placeholder="******" name="password">
              <span class="span-label ml-3 has-background-white">Password</span>
              <?php $__errorArgs = ['password'];
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
            <label class="is-flex mb-10">
              
              <input class="mt-1" type="checkbox" name="terms" value="1" name="remember">
              <span class="dark-pink is-inline-block ml-3">Remember me</span>
            </label>
            <div class="is-flex is-justify-content-end	mt-5 is-align-items-flex-end">
              <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="<?php echo e(route('home')); ?>">Back home</a></span>
              <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="<?php echo e(route('password.request')); ?>">Forgot your password?</a></span>
              <button class="button is-danger has-text-warning-light">Get Started</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/auth/login.blade.php ENDPATH**/ ?>