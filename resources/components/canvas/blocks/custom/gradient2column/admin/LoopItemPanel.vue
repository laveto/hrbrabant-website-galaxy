<template>

    <LoopItemPanel title="Item">

        <div class="canvas-blocks-custom-gradient2column-admin-LoopItemPanel">

            <LinkInput :options="loopItem"></LinkInput>

            <ColorsInput label="Item achtergrond kleur"
                instruction="Bepaal hier de achtergrondkleur van het gehele blok."
                :colors="colors"
                :options="loopItem"
                options-property="color"
                :open="true"
            />

        </div>

    <template v-slot:actionsExtra>
        <button class="btn btn-success" @click="save">
            <i class="mr-2 fas fa-check"></i> Opslaan
        </button>
    </template>

    </LoopItemPanel>

</template>

<script>

import LoopItemPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/loop/LoopItemPanel";
import ColorsInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/ColorsInput";
import getDatabaseColors from "@galaxy/modules/Canvas/resources/components/canvas/blocks/utils/text/admin/getDatabaseColors";
import LinkInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/LinkInput";

export default {

    extends: LoopItemPanel,

    components: {
        LoopItemPanel,
        ColorsInput,
        LinkInput,
    },

    data: function () {
        return {
            colors: null,
        }
    },

    mounted() {
        this.loadColors();
    },

    methods: {

        async loadColors() {
            // Grab database colors
            let databaseColors = (await getDatabaseColors(true)).data;

            // Initialize empty array
            this.colors = [
                'transparent',
                'white',
                'black',
            ];

            // Add colors from database to array
            $.each(databaseColors, (item, value) => {
                if (typeof value !== 'string') {
                    this.colors.push(...Object.values(value));
                } else {
                    this.colors.push(value);
                }
            })

            this.colors = _.uniq(this.colors);

            let formattedColors = {};

            for (const color of this.colors) {
                if (typeof color === 'object') {
                    for (const [key, value] of Object.entries(color)) {
                        formattedColors[key] = value;
                    }
                } else {
                    formattedColors[color] = color;
                }
            }

            this.colors = formattedColors;
        },

    },

}
</script>
