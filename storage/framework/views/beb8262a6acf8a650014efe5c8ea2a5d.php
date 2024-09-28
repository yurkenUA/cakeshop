<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="theme-light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://www.jsdelivr.com/package/npm/@creativebulma/bulma-tagsinput/dist/css/bulma-tagsinput.min.css" />

    </head>
    <body>
        <nav class="navbar is-link is-fixed-top">
            <div class="navbar-brand">
                <a class="navbar-item" href="<?php echo e(config('app.secure') ? 'https://' : 'http://'); ?><?php echo e(config('app.domain')); ?>"><?php echo e(config('app.domain')); ?></a>
            </div>

            <div class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item" href="/logout"><?php echo e(__('general.exit')); ?></a>
                </div>
            </div>
        </nav>
        <?php echo $__env->make('admin.helpers.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <!-- Scripts -->
        
        <script>
            window.Laravel = {}
        </script>
        <?php echo $__env->yieldPushContent('js'); ?>
    </body>
</html>
<?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/layouts/admin.blade.php ENDPATH**/ ?>