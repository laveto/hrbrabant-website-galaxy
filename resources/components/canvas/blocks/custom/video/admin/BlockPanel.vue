<template>

    <FloatingPanel>

        <div class="canvas::canvas-blocks-common-leftTextImageRight-BlockPanel">

            <MarginInput
                :options="options"
                :open="true"
            />

            <ColorsInput
                label="Achtergrondkleur deel 1"
                instruction="Bepaal hier de achtergrondkleur van de eerste helft."
                :colors="colors"
                :options="options"
                options-property="color"
            />

            <ColorsInput
                label="Achtergrondkleur deel 2"
                instruction="Bepaal hier de achtergrondkleur van het de tweede helft."
                :colors="colors"
                :options="options"
                options-property="color2"
            />

            <ColorsInput
                label="Tekstkleur"
                instruction="Bepaal hier de tekstkleur van het gehele blok."
                :colors="colors"
                :options="options"
                options-property="textColor"
            />

            <AnchorInput :options="options"/>

        </div>

    </FloatingPanel>

</template>

<script>

import AbstractPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel";
import FloatingPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel";
import ColorsInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/ColorsInput";
import AnchorInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/AnchorInput";
import MarginInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/MarginInput";
import getDatabaseColors from "../../../../../../../galaxy/modules/Canvas/resources/components/canvas/blocks/utils/text/admin/getDatabaseColors";

export default {

    extends: AbstractPanel,

    components: {
        FloatingPanel,
        ColorsInput,
        AnchorInput,
        MarginInput,
    },

    data() {
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
            let databaseColors = (await getDatabaseColors()).data;

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
