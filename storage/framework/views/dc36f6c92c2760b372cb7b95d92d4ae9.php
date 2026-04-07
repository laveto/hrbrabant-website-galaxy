<?php
    $logo = \Galaxy\Settings\Services\SettingsService::getModel('theme')->getFirstMedia('settings.website.logo');
    $themeSettings = \Galaxy\Settings\Services\SettingsService::getModel('theme');
?>
<header class="<?php echo e($cssNs); ?> flex bg-white py-3 sticky top-0 z-40 border-b">

    <div class="container flex items-center">

        <div class="flex items-center justify-between w-full mobile-nav lg:hidden">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logo): ?>
                <a class="w-1/2 sm:w-1/3" href="/">
                    <?=(new Galaxy\Core\BladeDirectives\MediaDirective($__env, $__data))->execute($logo, [
                        'collection' => 'settings.website.logo',
                        'fit' => 'object-contain',
                        'alt' => config('app.name')
                    ])?>
                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <button class="hamburger hamburger--slider" type="button"
                aria-label="Menu"
            >
                <span class="hamburger-box">
                    <span class="bg-black hamburger-inner"></span>
                </span>
            </button>

        </div>

        <div class="items-center hidden w-full lg:flex">

            <div class="w-1/6">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logo): ?>
                    <a class="logo" href="/">
                        <?=(new Galaxy\Core\BladeDirectives\MediaDirective($__env, $__data))->execute($logo, [
                            'collection' => 'settings.website.logo',
                            'fit' => 'object-contain',
                            'alt' => config('app.name')
                        ])?>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

            <div class="flex justify-end w-5/6 menu">

                <div class="flex text-sm font-semibold">

                    <?php echo $__env->make('website::partials.menu', [
                        'websiteMenuName' => 'Main',
                        'style' => 'navbar',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <div class="flex items-center pl-6 ml-auto font-normal">
                        <a href="<?php echo e($themeSettings['settings']['header_button_link'] ?? ''); ?>" class="text-sm btn-primary">
                            <?php echo e($themeSettings['settings']['header_button']); ?>

                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</header>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/views/vendor/website/layouts/main/header.blade.php ENDPATH**/ ?>