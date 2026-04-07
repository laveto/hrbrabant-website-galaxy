<template>

    <FloatingPanel>

        <div class="canvas::canvas-blocks-common-leftTextImageRight-BlockPanel">

            <TextInput
                label="Vacatures"
                instruction="Vul specifieke vacature-ID's in of voer een URL van de vacaturepagina in met filters."
                placeholder="HRSC00856,..."
                :options="options"
                options-property="vacancies"
                :open="true"
            />

            <CommonInputs
                :options="options"
            />

        </div>

    </FloatingPanel>

</template>

<script>

import AbstractPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel";
import FloatingPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel";
import CommonInputs from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/CommonInputs";
import TextInput from '@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/TextInput';

export default {

    extends: AbstractPanel,

    components: {
        FloatingPanel,
        CommonInputs,
        TextInput,
    },

}

</script>

<style lang="scss" scoped>

.canvas\:\:canvas-blocks-common-leftTextImageRight-BlockPanel {

}

</style>
