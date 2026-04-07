<?php $__env->startSection('body'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($js_body = \Galaxy\Settings\Services\SettingsService::get('advanced', 'js_body')): ?>
        <?php echo $js_body; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="<?php echo e($cssNs); ?>">

        
        <div class="flex flex-col min-h-screen wrapper">

            <?php echo $__env->make('website::layouts.main.creation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!config('website.multi_website.enabled')): ?>
                <?php echo $__env->make('website::layouts.main.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <div class='bg-white py-3 sticky top-[80px] z-50 lg:hidden'>
                    <?php echo $__env->make('canvas::socialIcons.render', [
                       'space' => 'flex items-center justify-center gap-4',
                       'textColor' => 'text-black block flex items-center justify-center',
                       // Its not really a footer but just checks for specific icon
                       'isFooter' => true,
                   ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( request()->websitePage() && request()->websitePage()->show_slider ): ?>
                    <?php echo $__env->make('website::layouts.main.slider', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="main">
                <?php echo $__env->yieldContent('main.content'); ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(livewire_installed() && config('website.livewire_enabled')): ?>
                    <?php echo e(@$slot); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="relative fixed-content">
                <?php echo $__env->make('website::layouts.main.fixed', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <div class="hidden lg:block fixed right-0 top-1/2 -translate-y-1/2 z-40 rounded-tl-2xl rounded-bl-2xl bg-[#A8403B] bg-opacity-[90%] py-6 px-2">
                    <?php echo $__env->make('canvas::socialIcons.render', [
                        'space' => 'flex flex-col gap-4',
                        'textColor' => 'text-white block flex items-center justify-center',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!config('website.multi_website.enabled')): ?>
                <?php echo $__env->make('website::layouts.main.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

        <?php echo $__env->make('website::partials.menu', [
            'websiteMenuName' => 'Mobiel',
            'style' => 'mmenu',
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->yieldPushContent('foot'); ?>

        <div class="modals">
            <?php echo $__env->make('website::partials.modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website::layouts.main.html', [
    'meta' => $meta ?? [
        'title' => (@$title ? "$title - " : '') . (\Galaxy\Settings\Services\SettingsService::get('common', 'website_title') ?: config('app.name')),
    ],
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/views/vendor/website/layouts/main.blade.php ENDPATH**/ ?>