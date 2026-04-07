<?php (extract($canvasAttrs ?? [])); ?>

<!DOCTYPE html>
<html
    lang="<?php echo e(config('settings.website_language.enabled')
        ? \Galaxy\Settings\Services\SettingsService::get('common', 'website_language') ?? 'nl'
        : str_replace('_', '-', request()->language())); ?>"
    class="<?php echo e(\App::environment('local') ? 'isLocal' : ''); ?> <?php echo e(request()->is(config('admin.routes.prefix').'/*') ? 'isAdmin' : ''); ?>"
    <?php if(isset($htmlAttrs)): ?> <?php echo $htmlAttrs; ?> <?php endif; ?> 
    <?php if($websitePage = request()->websitePage()): ?> <?php ($websiteStatisticPosterData = [
            'wpi' => $websitePage->id,
            'tc' => get_class($websitePage->website),
            'ti' => $websitePage->website->id,
            'auth' => auth('admin')->check() ? auth('admin')->user()->id : null,
            'class' => \Galaxy\Website\Models\WebsitePageProxy::modelClass(),
        ]); ?>
        data-website-statistic-poster='<?php echo json_encode($websiteStatisticPosterData, 15, 512) ?>' <?php endif; ?>>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>
        <?php echo e($meta['title'] ?? \Galaxy\Settings\Services\SettingsService::get('common', 'website_title') ?: config('app.name')); ?>

    </title>

    
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($description = $description ?? $websitePage->meta_description ?? false): ?>
        <meta name="description" content="<?php echo e($description); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($keywords = $keywords ?? $websitePage->meta_keywords ?? false): ?>
        <meta name="keywords" content="<?php echo e($keywords); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php ( $galaxySettingMedia = \Galaxy\Settings\Models\GalaxySetting::whereCategory('theme')->first()?->getMedia('settings.website.favicon') ); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( $galaxySettingMedia?->isNotEmpty() ): ?>
        <?php ($galaxySettingMediaFile = fn($fileName) => $galaxySettingMedia?->first(fn($media) => $media->file_name == $fileName)?->getUrl()); ?>
        <?php ($sizedFavicons = $galaxySettingMedia?->where(fn($media) => starts_with($media->file_name, 'favicon-') && ends_with($media->file_name, '.png'))); ?>

        <!-- Klassieke fallback -->
        <link rel="icon" href="<?php echo e($galaxySettingMediaFile('favicon.ico')); ?>" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo e($galaxySettingMediaFile('favicon.ico')); ?>" type="image/x-icon">

        
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e($galaxySettingMediaFile('apple-touch-icon.png')); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $sizedFavicons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favicon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <link rel="icon" type="image/png" sizes="<?php echo e(str_replace(['favicon-', '.png'], '', $favicon->file_name)); ?>" href="<?php echo e($favicon->getUrl()); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

    <?php else: ?>
        
        <?php ($iconPath = '/img/galaxy/common/icon/' . (config('website.multi_website.enabled') === true ? request()?->website()?->id . '/' : '')); ?>

        <!-- Klassieke fallback -->
        <link rel="icon" href="<?php echo e(asset($iconPath . 'favicon.ico')); ?>" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo e(asset($iconPath . 'favicon.ico')); ?>" type="image/x-icon">

        
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset($iconPath . 'apple-touch-icon.png')); ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset($iconPath . 'favicon-32x32.png')); ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset($iconPath . 'favicon-16x16.png')); ?>">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( !request()->websitePage()?->robot_index || config('app.env') !== 'production' || \Str::contains(config('app.url'), '.laveto.nl') ): ?>
        <meta name="robots" content="noindex, nofollow">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = (array) @$og; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <meta property="og:<?php echo e($key); ?>" content="<?php echo e($value); ?>" />
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <script>
        if (!(window.Promise && [].includes && Object.assign && window.Map)) {
            document.write('<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></scr' + 'ipt>')
        }
    </script>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(config('website.livewire_enabled')): ?>

        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scriptConfig(); ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->runningInAnyKindOfTest()): ?>
            <!-- Load livewire testing header if installed and running in test -->
            <script type="text/javascript">
                document.addEventListener("livewire:init", function(event) {
                    Livewire.hook('request', hookData => {
                        hookData.options.headers['X-is-testing'] = 'true';
                    });
                });
            </script>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <link href="https://use.typekit.net/ehv3jlc.css" rel="stylesheet">

    <?=(new Galaxy\Core\BladeDirectives\ResourceDirective($__env, $__data))->execute(array_merge([
            // Vendor JS
            '/vendor/jquery/dist/jquery.min.js',
            '/vendor/jquery-ui-dist/jquery-ui.min.js',
            '/vendor/lightgallery.js/dist/js/lightgallery.min.js',
            '/vendor/owl.carousel/dist/owl.carousel.min.js',

            config('website.livewire_enabled') ? '/vendor/livewire/livewire/dist/livewire.js' : '/vendor/alpinejs/dist/cdn.min.js',

            // Vendor CSS
            '/vendor/owl.carousel/dist/assets/owl.carousel.min.css',
            '/vendor/lightgallery.js/dist/css/lightgallery.min.css',
            '/vendor/@fortawesome/fontawesome-pro/css/all.min.css',

            // Concord modules.
            '/js/website/manifest.js',
            '/js/website/vendor.js',
            '/js/website/app.js',
            '/css/website.tw.css',
            '/css/website.css',
        ], config('website.settings.theme.resources', []),
        request()->is(config('admin.routes.prefix').'/*') ? [
            '/vendor/iframe-resizer/js/iframeResizer.js',
        ]: []),
        true,)?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( config('website.theme_settings.listStyles', false) ): ?>
        <link rel="stylesheet" href="<?php echo e(url('/api/css/dynamic-list-styles.css')); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?=(new Galaxy\Core\BladeDirectives\LinkResourcesDirective($__env, $__data))->execute()?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(config('website.livewire_enabled')): ?>
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo $__env->yieldPushContent('head'); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@\Galaxy\Settings\Services\SettingsService::get('theme')): ?>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="<?php echo e(\Galaxy\Website\Services\FontService::getGoogleFontLink()); ?>" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo e(url('/api/css/theme.css')); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($css = \Galaxy\Settings\Services\SettingsService::get('advanced', 'custom_css')): ?>
        <style>
            <?php echo $css; ?>

        </style>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( !request()->is(config('admin.routes.prefix').'/*') ): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($js_head = \Galaxy\Settings\Services\SettingsService::get('advanced', 'js_head')): ?>
            <?php echo $js_head; ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($cookies = \Galaxy\Settings\Services\SettingsService::get('cookies')) && ($cookies['active'] ?? true)): ?>
            
            <script id="cookie-scripts-start"></script>

            <script id="cookie-scripts-end"></script>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(config('website.structured_data.enabled') && (
        !config('website.multi_website.enabled') 
            || \Galaxy\Settings\Services\SettingsService::get('advanced', 'structured_data.enabled')
    )): ?>
        <?php echo $__env->yieldPushContent('structured-data'); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</head>

<body>
    <div class="<?php echo e($cssNs); ?> <?php echo e($htmlClass ?? ''); ?>"
        x-bind:class="{
            'h-screen overflow-hidden': fancyRedirect,
        }"
        x-data="{
            fancyRedirect: false,
            fancyRedirectTimer: null,
        }"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->isDevver() && !request()->is(config('admin.routes.prefix').'/*')): ?>
            <?php echo $__env->make('core::common.responsiveDebug', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Galaxy\Website\Models\GalaxySettingStatement::where('type', 'bar')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('website::partials.modal.statementBar', ['statement' => $statement], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( config('galaxy.common.wcag', false) 
            && config('galaxy.common.skiplinks', false) 
            && !request()->is(config('admin.routes.prefix').'/*')
        ): ?>
            <?php echo $__env->make('website::layouts.main.skiplinks', [
                'skiplinks' => config('galaxy.common.skiplinks'),
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( $showCanvasHeader ?? true ): ?>
            <?php echo $__env->make('website::layouts.main.canvas.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php echo $__env->yieldContent('body'); ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showCanvasFooter ?? true ): ?>
            <?php echo $__env->make('website::layouts.main.canvas.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="canvas-stack">
            <?php echo $__env->yieldPushContent('canvasBlocks'); ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if( config('website.cookies.bar.enabled')
            && ($cookies = \Galaxy\Settings\Services\SettingsService::getModel('cookies'))
            && ($cookies?->settings['active'] ?? false) && ($cookies?->settings['fields'] ?? false)
            && !request()->is(config('admin.routes.prefix').'/*')
        ): ?>
            <div class="py-4 text-sm text-center text-black bg-gray-200 cookieBar">
                <div class="container">
                    <a href="/cookies" class="" data-target="#cookiesModal"
                        x-on:click="window.dispatchEvent(new CustomEvent('show-cookies'))"
                    >
                        <?php echo e(__('Cookie-instellingen')); ?>

                    </a>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

</body>

</html>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/layouts/main/html.blade.php ENDPATH**/ ?>