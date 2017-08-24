<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="disabled"><span><?php echo app('translator')->getFromJson('往后翻'); ?></span></li>
        <?php else: ?>
            <li><a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev"><?php echo app('translator')->getFromJson('上一页'); ?></a></li>
        <?php endif; ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li><a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"><?php echo app('translator')->getFromJson('下一页'); ?></a></li>
        <?php else: ?>
            <li class="disabled"><span><?php echo app('translator')->getFromJson('没了,滚'); ?></span></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
