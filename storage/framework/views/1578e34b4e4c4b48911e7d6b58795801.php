<?php if($paginator->hasPages()): ?>
    <nav class="pagination is-centered">
        <?php if($paginator->onFirstPage()): ?>
            <a class="pagination-previous" disabled>Previous</a>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" class="pagination-previous">Previous</a>
        <?php endif; ?>

        <?php if($paginator->hasMorePages()): ?>
            <a class="pagination-next" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">Next</a>
        <?php else: ?>
            <a class="pagination-next" disabled>Next page</a>
        <?php endif; ?>

        <ul class="pagination-list">
            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li><span class="pagination-ellipsis"><span><?php echo e($element); ?></span></span></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li><a class="pagination-link is-current"><?php echo e($page); ?></a></li>
                        <?php else: ?>
                            <li><a href="<?php echo e($url); ?>" class="pagination-link"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </nav>
<?php endif; ?><?php /**PATH /Users/zatokafamily/Documents/Code/projects/cakeshop/resources/views/vendor/pagination/bulma.blade.php ENDPATH**/ ?>