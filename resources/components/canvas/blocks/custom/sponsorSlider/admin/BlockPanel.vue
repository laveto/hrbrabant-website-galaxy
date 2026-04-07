<template>

    <FloatingPanel>

        <div class="canvas::canvas-blocks-common-leftTextImageRight-BlockPanel">

            <CommonInputs
                :options="options"/>

        </div>

    </FloatingPanel>

</template>

<script>

import AbstractPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel";
import FloatingPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel";
import CommonInputs from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/CommonInputs";

export default {

    extends: AbstractPanel,

    components: {
        FloatingPanel,
        CommonInputs,
    },

}

</script>

<style lang="scss" scoped>

.canvas\:\:canvas-blocks-common-leftTextImageRight-BlockPanel {

}

</style>
