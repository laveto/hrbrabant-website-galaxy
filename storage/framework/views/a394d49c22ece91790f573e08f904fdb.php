<nav class="<?php echo e($cssNs); ?>" <?php if($style == 'mmenu'): ?> id="menu" <?php endif; ?> data-style="<?php echo e($style); ?>">
	<?php echo $__env->make($levelView, compact('websiteMenuPages'), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</nav>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/partials/menu.blade.php ENDPATH**/ ?>