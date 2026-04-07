<?php
    $isMail = starts_with(@$canvasBlock->options?->url, 'mailto:');
    if( $isMail ) {
        $email_contact = explode('@', str_replace('mailto:', '', $canvasBlock->options->url));
        $name = $email_contact[0];

        [$domain, $tld] = explode('.', $email_contact[1]);
    }

    // Check if any inline style options are set
    $hasInlineStyles = !empty(@$canvasBlock->options->backgroundColor)
        || !empty(@$canvasBlock->options->textColor)
        || @$canvasBlock->options->showBorder === 'aan';
?>

<<?php echo $options['tag'] ?? 'a'; ?> class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        $cssNs,
        $options['class'] ?? '',
        $canvasBlock->options->buttonPreset ?? ($canvasBlock->options->class ?? ''),
        $canvasBlock->options->borderRounded ?? '',
        'element-hidden' => !@$canvasBlock->options->required && (!@$canvasBlock->options->url && !@$canvasBlock->options->websitePageId),
    ]); ?>"
   href="<?php echo e(\Galaxy\Canvas\Services\CanvasService::getLink($canvasBlock->options)); ?>"
   <?php if( $isMail ): ?>
       data-name="<?php echo e($name); ?>"
       data-domain="<?php echo e($domain); ?>"
       data-tld="<?php echo e($tld); ?>"
       onclick="window.location.href = 'mailto:' + this.dataset.name + '@' + this.dataset.domain + '.' + this.dataset.tld; return false;"
   <?php endif; ?>
   <?php if($hasInlineStyles || !empty($options['backgroundColor']) || !empty($options['textColor'])): ?>
   style="
        <?php echo e(($bgColor = @$canvasBlock->options->backgroundColor ?? $options['backgroundColor'] ?? null) ? 'background: ' . $bgColor . ';' : ''); ?>

        <?php echo e(($textColor = @$canvasBlock->options->textColor ?? $options['textColor'] ?? null) ? 'color: ' . $textColor . ';' : ''); ?>

        <?php echo e(@$canvasBlock->options->showBorder === 'aan' ? 'border: ' . implode(' ', [@$canvasBlock->options->borderSize ?? '1px', @$canvasBlock->options->borderStyle ?? 'solid', @$canvasBlock->options->borderColor ?? 'black']) . ';' : ''); ?>

        <?php echo e('outline-color:' . (@$canvasBlock->options->showBorder === 'aan' ? (@$canvasBlock->options->borderColor ?? 'currentColor') : (@$canvasBlock->options->textColor ?? 'currentColor'))); ?>

    "
   <?php endif; ?>
   <?php if(@$canvasBlock->options->url || @$canvasBlock->options->websitePageId): ?> target="<?php echo e(@$canvasBlock->options->target ?? '_blank'); ?>" <?php endif; ?>
   <?=(new Galaxy\Canvas\BladeDirectives\CanvasBlockAttrsDirective($__env, $__data))->execute(['label' => 'Button'])?>
>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$options['prepend']): ?>
        <?php echo $options['prepend']; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$options['span'] !== false): ?> <span class="<?php echo e($options['spanClass'] ?? ''); ?>"> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(
            (@$edit 
                || @$canvasBlock->options->url 
                || ((@$canvasBlock->options->linkTarget == 'websitePage' || !@$canvasBlock->options->linkTarget)
                    &&  @$canvasBlock->options->websitePageId
                )
            ) && ($canvasBlock->options->icon_position ?? 'left') == 'left'
            && (bool)($canvasBlock->options->showIcon ?? true)
        ): ?>
            <?php echo @$canvasBlock->options->icon; ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!isset($canvasBlock->options->disableButtonText) || @$canvasBlock->options->disableButtonText === 'aan'): ?>
            <?php echo $canvasBlock->options->text ?? 'Knop tekst'; ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(
            (@$edit 
                || @$canvasBlock->options->url
                || ((@$canvasBlock->options->linkTarget == 'websitePage' || !@$canvasBlock->options->linkTarget)
                    &&  @$canvasBlock->options->websitePageId
                )
            ) && @$canvasBlock->options->icon_position == 'right'
            && (bool)($canvasBlock->options->showIcon ?? true)
        ): ?>
            <?php echo @$canvasBlock->options->icon; ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$options['span'] !== false): ?> </span> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$options['append']): ?>
        <?php echo $options['append']; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
</<?php echo $options['tag'] ?? 'a'; ?>>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Canvas/resources/components//canvas/blocks/utils/button/block.blade.php ENDPATH**/ ?>