<template>

    <FloatingPanel>

        <div class="canvas-blocks-custom-leftTextImageRight-BlockPanel">

             <accordion-input :open="true">
                <template #label>

                    <div class="font-medium text-gray-600">Formulier</div>

                </template>
                <template #content>

                     <v-select
                        :options="forms"
                        label="name"
                        v-model="options.form_id"
                        :reduce="form => form.id">

                        <div slot="no-options">Geen opties</div>

                    </v-select>

                </template>
            </accordion-input>

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

import axios from "axios";
import AbstractPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel";
import FloatingPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel";
import CommonInputs from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/CommonInputs";
import SwitchInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/SwitchInput";
import AccordionInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/helpers/Input";

export default {

    extends: AbstractPanel,

    components: {
        FloatingPanel,
        CommonInputs,
        SwitchInput,
        AccordionInput,
    },

    data() {
        return {
            forms: [],
        };
    },

    created() {
        this.loadForms();
    },

    methods: {

        async loadForms() {
            // Load artists.
            this.forms = (await axios.get(this.adminUrlPrefix + '/forms')).data;
        },

    },

}

</script>
