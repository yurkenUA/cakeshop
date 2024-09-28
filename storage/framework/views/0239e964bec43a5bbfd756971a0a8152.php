<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="<?php echo e(asset('css/auth.css')); ?>" rel="stylesheet">
        
    </head>
    <body>
        
        <?php echo $__env->yieldContent('content'); ?>

        <!-- Scripts -->
        <script src="<?php echo e(asset('js/app.js')); ?>" ></script>
    </body>
</html>
<?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/layouts/guest.blade.php ENDPATH**/ ?>