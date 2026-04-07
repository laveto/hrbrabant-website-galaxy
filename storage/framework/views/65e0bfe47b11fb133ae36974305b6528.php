<ul class="<?php echo e($cssNs); ?> <?php echo e($ulClass ?? ''); ?> list-unstyled <?php if(@$level == 0 && @$style !== 'mmenu'): ?> flex <?php endif; ?>">

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $websiteMenuPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $websiteMenuPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li <?php if(@$level == 0): ?> class="<?php echo e($liClass ?? 'w-full inline-flex'); ?>" <?php endif; ?>>

            <?php ($page = $websiteMenuPage->websitePage); ?>

            
            <a
                <?php if( $page->is_fancy_redirect ): ?>
                    x-on:click.prevent="fancyRedirect = true; fancyRedirectTimer = setTimeout(() => {
                        if( <?php echo e($page->target_blank ? 1 : 0); ?> ) {
                            window.open('<?php echo e(url()->websitePage($page)); ?>', '_blank');
                        } else {
                            window.location.href = '<?php echo e(url()->websitePage($page)); ?>';
                        }
                    }, 3000)"
                    href="#"
                <?php elseif(\Galaxy\Website\Services\WebsitePageService::getType($page) !== 'group'): ?>
                    href="<?php echo e(url()->websitePage($page)); ?>"
                    <?php echo e($page->target_blank ? 'target="_blank"' : ''); ?>

                <?php endif; ?>

                <?php if(@$level == 0): ?> class="<?php echo e($aClass ?? 'whitespace-nowrap text-gray-400 hover:text-gray-500'); ?>" <?php endif; ?>
            >
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imageSrc = $page->getFirstMediaUrl('icon')): ?>
                    <div class="relative icon">
                        <img class="img-fluid small" src="<?php echo e($imageSrc); ?>"
                            alt="<?php echo e($page->title_menu ?: $page->title_page); ?>">
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php echo e($page->title_menu ?: $page->title_page); ?>

            </a>

            
            <?php echo $__env->renderWhen($websiteMenuPage->children->isNotEmpty(), 'website::partials.menu.levelUl', [
                'websiteMenuPages' => $websiteMenuPage->children,
                'level' => @$level + 1,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($divider ?? false) && !$loop->last): ?>
                <div class="border-l <?php echo e($divider); ?>"></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</ul>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/partials/menu/levelUl.blade.php ENDPATH**/ ?>