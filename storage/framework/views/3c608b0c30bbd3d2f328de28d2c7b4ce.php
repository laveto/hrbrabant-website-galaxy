<div class="<?php echo e($cssNs); ?>">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($cookies = \Galaxy\Settings\Services\SettingsService::get('cookies')) 
        && ($cookies['active'] ?? false) && ($cookies['fields'] ?? false)
    ): ?>
        <?php echo $__env->make('website::partials.cookies', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/layouts/main/fixed.blade.php ENDPATH**/ ?>