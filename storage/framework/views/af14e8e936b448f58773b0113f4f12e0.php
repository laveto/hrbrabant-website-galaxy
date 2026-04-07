<?php $__env->startSection('main.content'); ?>

    <div class="<?php echo e($cssNs); ?>">

        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('vacancy.overview', ['websitePage' => $websitePage]);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-384386844-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website::layouts.main', [
    'title' => $websitePage->title_page ?: $websitePage->title_menu,
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/app/Modules/Vacancy/resources/components//website/modules/vacancy/index.blade.php ENDPATH**/ ?>