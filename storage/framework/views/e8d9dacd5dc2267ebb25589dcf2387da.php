<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(($video = \Galaxy\Canvas\Services\MediaService::getSingleMedia($canvasBlock)) ||
        !is_null(@$options['placeholder'])): ?>

    <div class="<?php echo e(@$edit ? 'relative' : ''); ?> w-full h-full video-container"
        x-data="{isPlaying : false}"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$options['thumbnail']): ?>
            <img x-show="!isPlaying" id="video-poster" src="<?php echo e(@$options['thumbnail']); ?>"
                 class="<?php echo e(@$options['videoClass'] ?? 'w-full h-full object-cover'); ?>"
                 alt="poster" />
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <video
                <?php echo e(@$options['playsinline'] == true || !isset($options['playsinline']) ? 'playsinline' : null); ?>

                <?php echo e(@$options['autoplay'] == true && !@$edit || !isset($options['autoplay']) && !@$edit ? 'autoplay' : null); ?>

                <?php echo e(@$options['muted'] == true || !isset($options['muted']) ? 'muted' : null); ?>

                <?php echo e(@$options['loop'] == true || !isset($options['loop']) ? 'loop' : null); ?>

                class="<?php echo e(@$options['videoClass'] ?? 'w-full h-full object-cover'); ?>"
                <?php echo e((bool)@$options['controls'] == true ? 'controls' : null); ?>

                preload="metadata"
                poster=<?php echo e(@$options['thumbnail'] ?? null); ?>

                x-show="isPlaying"
                x-ref="video"
                @play="isPlaying = true"
            >
                <source src="<?php echo e($video ? $video->getUrl() : @$options['placeholder']); ?>#t=0.001" type="<?php echo e($video?->mime_type); ?>">
                Your browser does not support the video tag.
            </video>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$options['thumbnail']): ?>
            <div x-show="!isPlaying" class="absolute inset-0 flex items-center justify-center">
                <button
                    @click="
                isPlaying = true;
                $refs.video.play();"
                    class="p-4 text-black transition-all bg-white rounded-full shadow-lg hover:bg-opacity-80"
                    style="font-size: 2rem; width: 80px; height: 80px; display: flex; justify-content: center; align-items: center;"
                >
                    <i class="fa-solid fa-play text-[#528870]"></i>
                </button>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(@$edit): ?>
            <div class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75 pointer-events-none">
                <div class="text-3xl font-medium text-center text-black">VIDEO</div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>

<?php elseif(@$edit): ?>

    <button type="button" class="relative block w-full p-12 text-center border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

        <div class="flex items-center justify-center">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>

        </div>

        <span class="block mt-2 text-sm font-medium text-gray-900"> Video toevoegen </span>

    </button>

<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/kevin/Herd/hrbrabant-website-galaxy/galaxy/modules/Canvas/resources/components//canvas/blocks/utils/video/video.blade.php ENDPATH**/ ?>