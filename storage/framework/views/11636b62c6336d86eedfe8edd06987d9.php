<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( config('app.debug') && config('app.env') !== 'production' && config('website.settings.creation.overlay') ): ?>
    <?php ($pageImage = '/img/website/creation/'. str_replace('/', '', url()->websitePage()) .'.png'); ?>

    <div class="<?php echo e($cssNs); ?> pointer-events-none absolute inset-0 z-50">
        <img class="absolute h-full object-top object-cover opacity-25 w-full"
             alt="Website overlay"
             src="<?php echo e(file_exists(public_path($pageImage)) ? url($pageImage) : asset('/img/website/creation/design.png')); ?>"
        />
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/layouts/main/creation.blade.php ENDPATH**/ ?>