<div class="<?php echo e($cssNs); ?> <?php echo e(@$space ?: 'space-x-2'); ?>" x-data='{ tooltip: false }' @click.away="tooltip = false">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = config('website.settings.social_media') ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialMediaName => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($icon) || !($socialValue = optional(\Galaxy\Settings\Services\SettingsService::get('common'))[$socialMediaName.'_link'])): ?>
            <?php continue; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="relative inline-block">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($socialMediaName == 'Telefoon' && !@$isFooter): ?>
                <a
                    href="#"
                    x-on:click.prevent="tooltip = !tooltip"
                    aria-label="<?php echo e($socialMediaName); ?>"
                    class="<?php echo e(@$textColor !== 'disabled' ? @$textColor : ''); ?> transition <?php echo e($stateClass ?? 'opacity-50 hover:opacity-100'); ?>"
                >
                    <i class="<?php echo e($icon['icon'] ?? $icon); ?> <?php echo e($iconClass ?? 'text-2xl'); ?>" aria-hidden="true" role="presentation"></i>
                </a>
                <span
                    x-show="tooltip"
                    class="absolute right-[50px] top-1 bg-palette-grayishlighterbue text-white text-xs rounded px-2 py-1 w-max"
                >
                    <a href="tel:<?php echo e($socialValue); ?>" class="hover:underline"
                        aria-label="<?php echo e($socialMediaName); ?>"
                    >
                        <?php echo e($socialValue); ?>

                    </a>
                </span>
            <?php elseif($socialMediaName == 'Telefoon' && @$isFooter): ?>
                <a
                    href="tel:<?php echo e($socialValue); ?>"
                    aria-label="<?php echo e($socialMediaName); ?>"
                    class="<?php echo e(@$textColor !== 'disabled' ? @$textColor : ''); ?> transition <?php echo e($stateClass ?? 'opacity-50 hover:opacity-100'); ?>"
                >
                    <i class="<?php echo e($icon['icon'] ?? $icon); ?> <?php echo e($iconClass ?? 'text-2xl'); ?>" aria-hidden="true" role="presentation"></i>
                </a>
            <?php else: ?>
                <a
                    href="<?php echo e($socialValue); ?>"
                    target="_blank"
                    aria-label="<?php echo e($socialMediaName); ?>"
                    class="<?php echo e(@$textColor !== 'disabled' ? @$textColor : ''); ?> transition <?php echo e($stateClass ?? 'opacity-50 hover:opacity-100'); ?>"
                >
                    <i class="<?php echo e($icon['icon'] ?? $icon); ?> <?php echo e($iconClass ?? 'text-2xl'); ?>" aria-hidden="true" role="presentation"></i>
                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/resources/views/vendor/canvas/socialIcons/render.blade.php ENDPATH**/ ?>