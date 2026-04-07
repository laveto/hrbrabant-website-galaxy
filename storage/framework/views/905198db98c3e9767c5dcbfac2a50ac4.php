<div x-init="
    $watch('mobileMenuOpen', function(value) { 
        if (value === false) 
            $dispatch('mobile-menu-closed'); 
        }
    ); 
    $nextTick(() => { mobileMenuOpen = false; })"
    x-on:item-focused-within-mobile-menu.window="itemFocusedWithinMobileMenu = $event.detail"
    x-on:mobile-menu-update.window="mobileMenuOpen = $event.detail.open; if ($event.detail.open && $event.detail.usingKeyboard) { $nextTick(() => $refs['mobileMenu'].querySelector('a').focus()) };"
    x-on:keydown.escape="mobileMenuOpen = false"
    x-on:focusin.window="if( !$refs['mobileMenu'].contains($event.target) && !$event.target.classList.contains('hamburger') ) { mobileMenuOpen = false; }"
    class="<?php echo e($cssNs); ?> relative z-[60]"
    x-data="{
        mobileMenuOpen: false,
        itemFocusedWithinMobileMenu: null,
    }"
    id="mobileMenu"
    x-ref="mobileMenu"
>
    <div class="fixed inset-0 transition duration-500 ease-in-out bg-gray-500 bg-opacity-75 opacity-0 pointer-events-none"
        x-bind:class="{ 'opacity-0 pointer-events-none': !mobileMenuOpen, 'opacity-100': mobileMenuOpen }"
        x-on:click="mobileMenuOpen = false">
    </div>

    <div class="inset-0 overflow-hidden pointer-events-none"
        x-bind:class="{ 'fixed': mobileMenuOpen, 'hidden': !mobileMenuOpen }"
    >
        <div class="absolute inset-0 overflow-hidden">
            <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 pointer-events-none">
                <div class="w-screen max-w-md transition duration-500 ease-in-out transform translate-x-full pointer-events-auto"
                    x-bind:class="{ 'translate-x-full': !mobileMenuOpen, 'translate-x-0': mobileMenuOpen }">
                    <div class="flex flex-col h-full py-6 overflow-y-auto transition bg-white"
                        x-bind:class="{ 'shadow-xl': mobileMenuOpen }">
                        <div class="px-4 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900">Menu</h2>
                                <div class="flex items-center ml-3 h-7">
                                    <button type="button" x-on:click="mobileMenuOpen = false"
                                        class="fixed top-0 right-0 z-20 mt-6 mr-5 text-gray-400 transition bg-white rounded-md hover:text-gray-500 focus:outline focus:outline-gray-500"
                                        tabindex="0"
                                    >
                                        <span class="sr-only">Close panel</span>
                                        <svg class="w-6 h-6"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" aria-hidden="true"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="relative flex-1 px-4 mt-6 sm:px-6">
                            <div class="absolute inset-0 px-4 sm:px-6">
                                <div class="flex flex-col divide-y">
                                    <?php echo $__env->make('website::partials.menu.levelMmenuSub', [
                                        'websitePageChildren' => \Galaxy\Website\Services\MenuService::getWebsiteMenuPages(
                                            \Galaxy\Website\Services\MenuService::getWebsiteMenu(@$websiteMenuName ?: 'Main')
                                        ),
                                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                                    <?php if ($__env->exists('website::partials.menu.levelMmenuExtra')) echo $__env->make('website::partials.menu.levelMmenuExtra', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/partials/menu/levelMmenu.blade.php ENDPATH**/ ?>