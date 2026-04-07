<div class="<?php echo e($cssNs); ?> fixed inset-0 z-[60] overflow-y-auto flex flex-col items-center justify-center p-4 pointer-events-auto" 
    x-show="fancyRedirect"
    x-cloak
    x-on:keydown.escape.window="fancyRedirect = false; clearTimeout(fancyRedirectTimer)"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>

    <div class="absolute inset-0 bg-black opacity-50 pointer-events-none -z-10"></div>

    <div class="relative z-10 px-8 py-8 bg-white rounded-lg md:w-1/2">
        <div class="absolute top-0 right-0 mt-2 mr-4 md:mt-4 md:mr-6">
            <button class="text-lg text-gray-500 cursor-pointer md:text-2xl close hover:text-gray-300 focus:outline-none focus:text-gray-500" 
                x-on:click="fancyRedirect = false; clearTimeout(fancyRedirectTimer)"
            >
                <i class="fas fa-times"></i>
            </button>
        </div>

        <img class="w-1/2 h-auto mx-auto" src="<?php echo e(asset('img/website/logo.svg')); ?>" alt="<?php echo e('Logo ' . config('app.name')); ?>">

        <div class="mt-4 text-center">
            <h2 class="text-2xl font-bold"><?php echo e(__('Je wordt doorgestuurd')); ?></h2>
            <p class="mt-2 text-base text-gray-500"><?php echo e(__('Je wordt doorgestuurd naar een andere pagina.')); ?></p>
        </div>

        <div class="flex justify-center mt-4">
            <i class="text-gray-500 fas fa-loader fa-spin fa-2x"></i>
        </div>

        <div class="flex justify-center mt-4">
            <button class="text-sm font-medium text-gray-400 transition-all duration-300 rounded-md focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-50" 
                x-on:click="fancyRedirect = false; clearTimeout(fancyRedirectTimer)"
            >
                <?php echo e(__('Annuleren')); ?>

            </button>
        </div>

    </div>

</div><?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Website/resources/views/partials/modal/redirect.blade.php ENDPATH**/ ?>