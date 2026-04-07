<template>

    <FloatingPanel>

        <div class="canvas-blocks-custom-leftTextImageRight-BlockPanel">

            <SwitchInput
                label="Toon standaard afbeelding"
                instruction="Indien ingeschakeld, wordt de standaard afbeelding getoond die geupload is in de blokken module."
                :options="options"
                :items="[
                    { value: 0, label: 'Nee' },
                    { value: 1, label: 'Ja' },
                ]"
                :defaultValue="1"
                options-property="showDefaultImage"
                :open="true"
            />

            <CommonInputs
                :options="options"
                :open="false"
            />

        </div>

    </FloatingPanel>

</template>

<script>

import AbstractPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel";
import FloatingPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel";
import CommonInputs from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/CommonInputs";
import SwitchInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/SwitchInput";

export default {

    extends: AbstractPanel,

    components: {
        FloatingPanel,
        CommonInputs,
        SwitchInput,
    },

}

</script>

<style lang="scss" scoped>

.canvas\:\:canvas-blocks-common-leftTextImageRight-BlockPanel {

}

</style>
