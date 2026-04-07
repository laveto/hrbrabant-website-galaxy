<div class="website::partials-menu-LevelNavbar-custom">

    <ul class="flex gap-6 text-black">

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $websiteMenuPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $websiteMenuPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li
                <?php if($websiteMenuPage->children->isNotEmpty()): ?>
                    x-data="{
                    isOpen: false,
                }"
                x-on:mouseover="isOpen = true"
                x-on:mouseout="isOpen = false"
                <?php endif; ?>
            >

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($childs = $websiteMenuPage->children)): ?>
                    <?php
                        $hasActiveChild = false;
                        $websiteMenuPage->children->each(function ($child) use (&$hasActiveChild) {
                            if ( \Galaxy\Website\Services\WebsitePageService::activePage($child, false) ) {
                                $hasActiveChild = true;
                            }
                        });
                    ?>

                    <?php ($websiteMenuPageActiveChild = \Galaxy\Website\Services\WebsitePageService::activePage($websiteMenuPage, $hasActiveChild)); ?>
                    <a class="inline-block px-2 py-3 hover:opacity-50 relative dropdown-toggle <?php echo e($websiteMenuPageActiveChild ? "active" : ''); ?>"
                       href="<?php echo e(url()->websitePage($websiteMenuPage->websitePage)); ?>"
                       <?php echo e($websiteMenuPage->websitePage->target_blank ? 'target="_blank"' : ''); ?> role="button"
                       aria-haspopup="true"
                       aria-expanded="false"
                    >
                        <?php echo e($websiteMenuPage->websitePage->title_menu ?: $websiteMenuPage->websitePage->title_page); ?>


                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( $websiteMenuPageActiveChild ): ?>
                            <div class="absolute bg-palette-portizBlue bottom-0 h-2 left-4 right-4 translate-y-1/2"></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </a>

                    <div class="absolute bg-palette-portizBlue divide-gray-200 divide-opacity-25 divide-y dropdown-menu flex flex-col px-4 py-2"
                         aria-labelledby="navbarDropdown"
                         x-show="isOpen"
                         x-transition:enter="transition ease-out duration-100 transform"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75 transform"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                    >

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $websiteMenuPageChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($websitePageChild = $websiteMenuPageChild->websitePage); ?>
                            <a class="inline-block py-2 hover:opacity-50 <?php echo e(\Galaxy\Website\Services\WebsitePageService::activePage($websiteMenuPageChild, false) ? 'active' : ''); ?>"
                               href="<?php echo e(url()->websitePage($websitePageChild)); ?>"
                                <?php echo e($websitePageChild->target_blank ? 'target="_blank"' : ''); ?>

                            ><?php echo e($websitePageChild->title_menu ?: $websitePageChild->title_page); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                    
                <?php else: ?>
                    <?php ($page = $websiteMenuPage->websitePage); ?>
                    <?php ($websiteMenuPageActive = \Galaxy\Website\Services\WebsitePageService::activePage($websiteMenuPage, false)); ?>
                    <a class="relative inline-block px-2 py-3 hover:opacity-50-fh <?php echo e($websiteMenuPageActive && !$page->redirect
                        ? 'active'
                        : ''); ?>"
                       href="<?php echo e(url()->websitePage($page)); ?>" <?php echo e(@$page->target_blank ? 'target="_blank"' : ''); ?>

                    >
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menuIsActive = config('website.pages.bar.menu.active') && ($icon = @$page->getFirstMediaUrl('icon'))): ?>
                            <span class="flex items-center">
                                <img class="img-fluid pr-4 h-1em" src="<?php echo e($icon); ?>" alt="icon">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <?php echo e($page->title_menu ?: $page->title_page); ?>


                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menuIsActive): ?>
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( $websiteMenuPageActive ): ?>
                            <div class="absolute bg-palette-portizBlue bottom-0 h-2 left-4 right-4 translate-y-1/2"></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </ul>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/views/vendor/website/partials/menu/levelNavbar.blade.php ENDPATH**/ ?>