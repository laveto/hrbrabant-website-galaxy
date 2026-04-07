<div x-data="{ 
    scrollToVacancy: () => {
        const vacancyElement = document.querySelector('#vacancies');
        if (vacancyElement) {
            window.scrollTo({
                top: vacancyElement.offsetTop - 25,
                behavior: 'smooth'  // Optional, for smooth scrolling
            });
        }
    } 
}">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasPages()): ?>
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default select-none">
                            <?php echo __('pagination.previous'); ?>

                        </span>
                    <?php else: ?>
                        <a href="?page=<?php echo e($paginator->currentPage() - 1); ?>"
                           wire:click.prevent="previousPage('<?php echo e($paginator->getPageName()); ?>'); scrollToVacancy()"
                           wire:loading.attr="disabled"
                           dusk="previousPage<?php echo e($paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName()); ?>.before"
                           class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                            <?php echo __('pagination.previous'); ?>

                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </span>

                <span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
                        <a href="?page=<?php echo e($paginator->currentPage() + 1); ?>"
                           wire:click.prevent="nextPage('<?php echo e($paginator->getPageName()); ?>'); scrollToVacancy()"
                           wire:loading.attr="disabled"
                           dusk="nextPage<?php echo e($paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName()); ?>.before"
                           class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                            <?php echo __('pagination.next'); ?>

                        </a>
                    <?php else: ?>
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 rounded-md cursor-default select-none">
                            <?php echo __('pagination.next'); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">

                <div>
                    <span class="relative z-0 flex flex-wrap items-center">
                        <span class='mr-4'>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
                                <span aria-disabled="true" aria-label="<?php echo e(__('pagination.previous')); ?>">
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-400 bg-white border border-gray-300 rounded-full cursor-disabled" aria-hidden="true">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            <?php else: ?>
                                <a href="?page=<?php echo e($paginator->currentPage() - 1); ?>"
                                   wire:click.prevent="previousPage('<?php echo e($paginator->getPageName()); ?>'); scrollToVacancy()"
                                   dusk="previousPage<?php echo e($paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName()); ?>.after"
                                   rel="prev"
                                   class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 bg-white border border-gray-300 rounded-full hover:bg-palette-lightblue hover:text-white hover:border-palette-lightblue"
                                   aria-label="<?php echo e(__('pagination.previous')); ?>">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </span>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_string($element)): ?>
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 bg-white cursor-default select-none"><?php echo e($element); ?></span>
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($element)): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span wire:key="paginator-<?php echo e($paginator->getPageName()); ?>-page<?php echo e($page); ?>" class='px-2'>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page == $paginator->currentPage()): ?>
                                            <span aria-current="page">
                                                <span class="h-10 rounded-full min-w-[50px] relative inline-flex justify-center items-center px-4 py-2 text-sm bg-palette-lightblue font-medium text-white cursor-default leading-5 select-none"><?php echo e($page); ?></span>
                                            </span>
                                        <?php else: ?>
                                            <a href="?page=<?php echo e($page); ?>"
                                               wire:click.prevent="gotoPage(<?php echo e($page); ?>, '<?php echo e($paginator->getPageName()); ?>'); scrollToVacancy()"
                                               class="h-10 rounded-full min-w-[50px] relative inline-flex justify-center items-center px-4 py-2 text-sm font-medium hover:text-white bg-white leading-5 focus:z-10 focus:outline-none hover:bg-palette-lightblue"
                                               aria-label="<?php echo e(__('Go to page :page', ['page' => $page])); ?>">
                                                <?php echo e($page); ?>

                                            </a>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <span class='ml-4'>
                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
                                <a href="?page=<?php echo e($paginator->currentPage() + 1); ?>"
                                   wire:click.prevent="nextPage('<?php echo e($paginator->getPageName()); ?>'); scrollToVacancy()"
                                   dusk="nextPage<?php echo e($paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName()); ?>.after"
                                   rel="next"
                                   class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 bg-white border border-gray-300 rounded-full hover:bg-palette-lightblue hover:text-white hover:border-palette-lightblue"
                                   aria-label="<?php echo e(__('pagination.next')); ?>">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            <?php else: ?>
                                <span aria-disabled="true" aria-label="<?php echo e(__('pagination.next')); ?>">
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-400 bg-white border border-gray-300 rounded-full cursor-disabled" aria-hidden="true">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/app/Modules/Vacancy/resources/components//website/modules/vacancy/partials/pagination.blade.php ENDPATH**/ ?>