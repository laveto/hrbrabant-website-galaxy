<template>
    <FloatingPanel>
        <div class="canvas-blocks-custom-elfsight-BlockPanel">
            <div class="m-5">

                <div class="mb-1 text-gray-600">Elfsight script</div>

                <small class="block mb-3 text-gray-500 text-muted">
                    Plaats hier de code vanaf elfsight
                </small>

                <textarea
                    class="focus:border-blue-300 focus:outline-none focus:shadow-outline-blue form-control form-input sm:leading-5 sm:text-sm border border-gray-300 border-solid ease-in-out mt-1 px-3 py-2 rounded-md shadow-sm transition w-full"
                    v-model="options.elfsight_link"
                />

            </div>

            <div slot="Algemeen">
                <CommonInputs :options="options" />
            </div>
        </div>
    </FloatingPanel>
</template>

<script>
import AbstractPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel';
import FloatingPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel';
import CommonInputs from '@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/CommonInputs';

export default {
    extends: AbstractPanel,

    components: {
        FloatingPanel,
        CommonInputs,
    },
};
</script>
