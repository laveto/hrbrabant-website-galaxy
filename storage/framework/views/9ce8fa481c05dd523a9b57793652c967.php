<?php ($previousWebsiteMenuPage = $websiteMenuPage ?? null); ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $websitePageChildren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $websiteMenuPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php ($websitePageIsGroup = \Galaxy\Website\Services\WebsitePageService::getType($websiteMenuPage->websitePage) === 'group'); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($websiteMenuPage->children->count() < 1): ?>
        <a class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'block py-4',
                'text-gray-900' => !$websitePageIsGroup,
                'text-gray-400' => $websitePageIsGroup,
            ]); ?>"
            <?php if( $websiteMenuPage->websitePage->is_fancy_redirect ): ?>
                x-on:click.prevent="fancyRedirect = true; fancyRedirectTimer = setTimeout(() => {
                    if( <?php echo e($websiteMenuPage->websitePage->target_blank ? 1 : 0); ?> ) {
                        window.open('<?php echo e(url()->websitePage($websiteMenuPage->websitePage)); ?>', '_blank');
                    } else {
                        window.location.href = '<?php echo e(url()->websitePage($websiteMenuPage->websitePage)); ?>';
                    }
                }, 3000)"
                href="#"
            <?php elseif(\Galaxy\Website\Services\WebsitePageService::getType($websiteMenuPage->websitePage) !== 'group'): ?>
                href="<?php echo e(url()->websitePage($websiteMenuPage->websitePage)); ?>"
                <?php echo e($websiteMenuPage->websitePage->target_blank ? 'target="_blank"' : ''); ?> 
            <?php endif; ?>
            tabindex="0"
            :aria-hidden="!open"
            
            <?php if( $loop->last ): ?>
                x-on:keydown.tab="open = false;"
            <?php endif; ?>
        >
            <?php echo e($websiteMenuPage->websitePage->title_menu ?: $websiteMenuPage->websitePage->title_page); ?>

        </a>
    <?php else: ?>
        <div x-data="{ open: false }"
            x-on:close-submenu="$event.detail.target === $refs['menuItem-<?php echo e($websiteMenuPage->id); ?>'] && (open = false)"
            id="menuItem-<?php echo e($websiteMenuPage->id); ?>"
            x-ref="menuItem-<?php echo e($websiteMenuPage->id); ?>"
        >

            <?php ($uniqueAccordionName = \Galaxy\Website\Services\MenuService::getUniqueAccordionName($websiteMenuPage, @$loop->iteration ?? 1)); ?>
            <<?php echo $websiteMenuPage->websitePage->is_group && $websiteMenuPage->children ? 'a' : 'div'; ?>

                class="flex justify-between lg:cursor-auto"
                <?php if( $websiteMenuPage->websitePage->is_group ): ?>
                    x-on:click="open = !open"
                    href="#"
                    class="text-gray-600"
                <?php endif; ?>
            >

                <<?php echo !$websitePageIsGroup ? 'a' : 'div'; ?>

                    class="flex-1 py-4"
                    <?php if( !$websitePageIsGroup ): ?>
                        href="<?php echo e(url()->websitePage($websiteMenuPage->websitePage)); ?>"
                        <?php echo e($websiteMenuPage->websitePage->target_blank ? 'target="_blank"' : ''); ?>

                    <?php endif; ?>
                    tabindex="0"
                    :aria-hidden="!open"
                >
                    <?php echo e($websiteMenuPage->websitePage->title_menu ?: $websiteMenuPage->websitePage->title_page); ?>

                </<?php echo !$websitePageIsGroup ? 'a' : 'div'; ?>>

                <<?php echo !$websitePageIsGroup ? 'a' : 'div'; ?> class="inline-flex items-center flex-shrink-0 px-4 -mr-4 focus:outline"
                    <?php if( !$websitePageIsGroup ): ?>
                        x-on:click="open = !open"
                    <?php endif; ?>
                    role="button"
                    tabindex="0"
                    aria-label="Open submenu"
                    x-on:keydown.enter="open = !open"
                    x-bind:aria-expanded="open"
                    x-bind:aria-controls="'<?php echo e($uniqueAccordionName); ?>'"
                    id="menuItem-<?php echo e($websiteMenuPage->id); ?>-button"
                    <?php if( $loop->last ): ?>
                        x-on:blur="!open && $dispatch('close-submenu', { target: document.querySelector('[x-ref=\'menuItem-<?php echo e($previousWebsiteMenuPage?->id); ?>\']') })"
                    <?php endif; ?>
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 transition">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </<?php echo !$websitePageIsGroup ? 'a' : 'div'; ?>>

            </<?php echo $websitePageIsGroup ? 'a' : 'div'; ?>>

            <div class="fixed inset-0 z-10 h-full pt-4 pb-16 overflow-y-auto bg-white"
                x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-200 transform"
                x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150 transform"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 translate-x-full"
                aria-labelledby="menuItem-<?php echo e($websiteMenuPage->id); ?>-button"
                role="dialog"
                aria-modal="true"
            >
                <div class="flex items-center justify-between px-5 mb-4 sm:px-6">
                    <div class="mr-2"
                        x-on:click="open = false"
                        tabindex="0"
                        role="button"
                        aria-label="Close submenu"
                        x-on:keydown.shift.tab="open = false"
                        x-on:keydown.enter="open = false"
                    >
                        <i class="text-2xl fal fa-angle-left"></i>
                    </div>

                    <h2 class="mb-0 text-lg font-medium text-gray-900">Menu</h2>

                    <div class="flex items-center ml-3 h-7">
                        <!-- Close button space -->
                    </div>
                </div>

                <div class="px-5 overflow-y-auto sm:px-6">
                    <div class="mt-8">
                        <h4>
                            <?php echo e($websiteMenuPage->websitePage->title_menu ?: $websiteMenuPage->websitePage->title_page); ?>

                        </h4>
                    </div>

                    <div class="divide-y">
                        <?php echo $__env->make('website::partials.menu.levelMmenuSub', [
                            'websitePageChildren' => $websiteMenuPage->children,
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>

            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/partials/menu/levelMmenuSub.blade.php ENDPATH**/ ?>