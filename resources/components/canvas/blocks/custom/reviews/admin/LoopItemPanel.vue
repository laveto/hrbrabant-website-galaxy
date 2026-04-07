<template>

    <LoopItemPanel title="Slide">

        <div class="canvas-blocks-custom-reviews-admin-LoopItemPanel">

            <accordion-input :open="true">
                <template #label>

                    <div class="font-medium text-gray-600">Rating</div>

                </template>
                <template #content>
                    <small class="block mb-3 text-gray-500 label text-muted">
                        Sterren in de review worden gevuld op basis van de input die van 0-100 loopt.
                    </small>

                    <input type="number" min="0" max="100" v-model="loopItem.rating"
                        class="w-full rounded-md border-gray-300"
                       placeholder="80"
                    />

                </template>
            </accordion-input>

        </div>

        <template v-slot:actionsExtra>
            <button class="btn btn-success" @click="save">
                <i class="fas fa-check mr-2"></i> Opslaan
            </button>
        </template>

    </LoopItemPanel>

</template>

<script>

import LoopItemPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/loop/owlCarousel/LoopItemPanel";
import AccordionInput from '@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/helpers/Input';

export default {

    extends: LoopItemPanel,

    components: {
        LoopItemPanel,
        AccordionInput,
    },

    data() {
        return {};
    },

}
</script>
