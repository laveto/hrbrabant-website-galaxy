
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(\concord()->module('website') && ($cookies = \Galaxy\Settings\Services\SettingsService::get('cookies'))
    && ($cookies['active'] ?? false) && ($cookies['fields'] ?? false)
): ?>

    <div id="cookiesModal"
        class="relative flex items-end justify-center md:items-center"
        x-init="fetchAcceptedCookies()"
        x-data="showCookies()"
        x-ref="cookiesModal"
        x-on:show-cookies.window="showAnyways = true"
    >

        <div class="<?php echo e($cssNs); ?>"
            x-cloak
            x-show="!hasAcceptedCookies || showAnyways"
        >

            <?=(new Galaxy\Crud\BladeDirectives\InputStyleDirective($__env, $__data))->execute('cookieForm')?>

            <form class="flex items-end w-full md:items-center" method="post" action="/save-cookies">

                <!-- Modal content-->
                <div class="flex flex-col w-full max-w-full max-h-full px-6 py-4 m-2 overflow-hidden break-words bg-white shadow-lg md:h-auto md:px-14 md:py-8 panel-content rounded-2xl">

                    <div class="flex items-center mb-4 md:mb-6">

                        <div class="text-lg font-bold md:text-2xl"><?php echo e(__('Cookie-instellingen')); ?></div>

                        <button type="button" class="inline-flex items-center self-start justify-center w-8 h-8 ml-auto text-2xl leading-none text-gray-500 rounded-full cursor-pointer close hover:text-gray-300 focus:outline-none focus:ring-1 focus:ring-black"
                            aria-label="<?php echo e(__('Sluit cookie-instellingen')); ?>"
                            data-dismiss="panel"
                        ><i class="fa-solid fa-times"></i></span>

                    </div>

                    <div class="flex flex-col -m-2 overflow-auto panel-body">

                        <div class="flex flex-col p-2 overflow-y-auto divide-y inputs">

                            <?php ($acceptedCookies = array_keys(Cookie::get())); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cookies['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php ($cookie = fn($key) => $field[$key][request()->language()] 
                                    ?? $field[$key][head(config('core.languages'))] 
                                    ?? $field[$key]
                                    ?? null
                                ); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$field['active']): ?>
                                    <?php continue; ?>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                <div id="<?php echo e(str_slug($cookie('name'))); ?>" class="">

                                    <div class="flex flex-col py-4"
                                        x-data="{ open: false }"
                                    >

                                        <div class="flex items-center justify-between gap-4">

                                            <?=(new Galaxy\Crud\BladeDirectives\InputDirective($__env, $__data))->execute('switch', [
                                                'name' => 'set_cookies['. $loop->iteration . '][active]',
                                                'label' => false,
                                                'disabled' => @$field['required'],
                                                'value' => @$field['required'] ? 1 : (
                                                    ($field['key'] ?? $cookie('name') ?? false) 
                                                        ? in_array(str_slug($field['key'] ?? $cookie('name')), $acceptedCookies) 
                                                        : 0
                                                ),
                                                'size' => 'large',
                                                'secondaryAttributes' => [
                                                    'aria-label' => __('Schakel :name in of uit', ['name' => $cookie('name')]),
                                                ]
                                            ])?>

                                            <span class="font-medium cursor-pointer md:text-lg"
                                                x-on:click="open = !open"
                                            ><?php echo e($cookie('name')); ?></span>

                                            <button type="button"
                                                x-on:click="open = !open"
                                                class="flex items-center justify-center flex-shrink-0 w-8 h-8 ml-auto border border-transparent rounded-full focus:border-black focus:outline-none"
                                                aria-label="<?php echo e(__('Meer informatie over :name', ['name' => $cookie('name')])); ?>"
                                                x-bind:aria-expanded="open"
                                            >
                                                <i class="fas fa-chevron-down" x-show="!open" x-cloak></i>
                                                <i class="fas fa-chevron-up" x-show="open"></i>
                                            </button>

                                        </div>

                                        <div class="mt-4 text-sm" x-show="open">
                                            <div class="cookie_description"><?php echo e($cookie('description')); ?></div>
                                        </div>

                                    </div>

                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                        <div class="flex flex-col gap-4 p-2 md:flex-row lg:pb-8">

                            <button name="allCookies"
                                value="1"
                                type="submit"
                                <?php if(@$cookies['button_color']): ?>
                                    style="background-color: <?php echo e($cookies['button_color']); ?>"
                                <?php endif; ?>
                                class="px-6 py-4 text-sm text-white bg-black rounded-md hover:opacity-80 focus:ring-1 focus:ring-black focus:ring-offset-2 focus:outline-none"
                            >
                                <?php echo e(__('Accepteer alle cookies')); ?>

                            </button>

                            <button name="cookies"
                                type="submit"
                                <?php if(@$cookies['button_color']): ?>
                                    style="background-color: <?php echo e($cookies['button_color']); ?>"
                                <?php endif; ?>
                                class="px-6 py-4 text-sm text-white bg-black rounded-md hover:opacity-80 focus:ring-1 focus:ring-black focus:ring-offset-2 focus:outline-none"
                                aria-label="<?php echo e(__('Cookie voorkeuren opslaan')); ?>"
                            >
                                <?php echo e(__('Voorkeuren opslaan')); ?>

                            </button>

                            <button name="allCookies"
                                value="0"
                                type="submit"
                                <?php if(@$cookies['button_color']): ?>
                                    style="background-color: <?php echo e($cookies['button_color']); ?>"
                                <?php endif; ?>
                                class="px-6 py-4 text-sm text-white bg-black rounded-md hover:opacity-80 focus:ring-1 focus:ring-black focus:ring-offset-2 focus:outline-none"
                            >
                                <?php echo e(__('Weigeren')); ?>

                            </button>

                        </div>

                    </div>

                </div>

            </form>

            <?=(new Galaxy\Crud\BladeDirectives\PopInputStyleDirective($__env, $__data))->execute()?>

        </div>

    </div>

    <script>
        function showCookies() {
            return {
                hasAcceptedCookies: true,
                showAnyways: false,

                async fetchAcceptedCookies() {
                    await fetch('/has-accepted-cookies').then(async (response) => {
                        let data = await response.json();
                        this.hasAcceptedCookies = data.accepted;
                    })
                }
            }
        }
    </script>

<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php echo $__env->make('website::partials.modal.redirect', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = \Galaxy\Website\Models\GalaxySettingStatement::where('type', 'popup')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('website::partials.modal.statement', ['statement' => $statement], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/partials/modal.blade.php ENDPATH**/ ?>