<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(config('core.debug_bar')): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (\Illuminate\Support\Facades\Blade::check('debug')): ?>
        <!--do-not-cache-->
        <div class="<?php echo e($cssNs); ?> <?php echo e(@$class ?? 'pointer-events-none fixed left-0 right-0 z-50 mt-4'); ?>">

            <div
                class="flex items-center justify-between w-48 px-4 py-2 mx-auto font-bold text-center text-white bg-black bg-opacity-25 rounded-lg flex-nowrap sm:w-80">

                <div class="pointer-events-auto">
                    <div class="debug">
                        <i class="text-xl far fa-debug"></i>
                    </div>
                </div>

                <div class="block sm:hidden"><i class="pr-1 far fa-mobile"></i>XS</div>
                <div class="hidden sm:block md:hidden"><i class="pr-1 far fa-mobile"></i>SM</div>
                <div class="hidden md:block lg:hidden"><i class="pr-1 far fa-tablet"></i>MD</div>
                <div class="hidden lg:block xl:hidden"><i class="pr-1 far fa-desktop"></i>LG</div>
                <div class="hidden xl:block 2xl:hidden"><i class="pr-1 far fa-desktop"></i>XL</div>
                <div class="hidden 2xl:block"><i class="pr-1 far fa-desktop"></i>2XL</div>

                <?php
                    $queryLog = DB::getQueryLog();
                    $logCount = count($queryLog);
                    $queryTime = collect($queryLog)->sum('time');
                    $formattedTime = number_format((float) $queryTime, 2, '.', '');
                ?>

                <div
                    class="<?php echo e($logCount < 30 ? 'text-green-500' : ($logCount < 50 ? 'text-yellow-500' : 'text-red-500')); ?>">
                    <i class="pr-1 fal fa-database"></i>
                    <?php echo e($logCount); ?>

                </div>

                <div
                    class="<?php echo e($queryTime < 30 ? 'text-green-500' : ($queryTime < 50 ? 'text-yellow-500' : 'text-red-500')); ?> hidden sm:block">
                    <i class="pr-1 far fa-stopwatch"></i>
                    <?php echo e($formattedTime); ?>ms
                </div>

            </div>

        </div>
        <!--/do-not-cache-->
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Core/resources/views/common/responsiveDebug.blade.php ENDPATH**/ ?>