<template>

    <FloatingPanel title="Instellingen">

        <div class="member::canvas-blocks-modules-members-BlockPanel">

            <Tabs :tabs="[
                'Instellingen',
                'Algemeen',
            ]">

                <div slot="Instellingen">

                    <SwitchInput
                        label="Toon titel?"
                        :options="options"
                        options-property="show_title"
                        :items="[
                            { value: '1', label: 'Ja'},
                            { value: '0', label: 'Nee'},
                        ]"
                        defaultValue="1"
                        :open="true"
                    />

                    <accordion-input :open="false">
                        <template #label>
                            <div class="font-medium text-gray-600">Filter op locatie</div>
                        </template>
                        <template #content>
                            <v-select
                                :options="locations"
                                label="label"
                                v-model="options.location"
                                :reduce="location => location.value"
                                clearable
                                placeholder="Selecteer een locatie (optioneel)">
                                <div slot="no-options">Geen locaties gevonden</div>
                            </v-select>
                        </template>
                    </accordion-input>

                </div>

                <div slot="Algemeen">

                    <CommonInputs
                        :options="options"
                    />

                </div>

            </Tabs>

        </div>

    </FloatingPanel>

</template>

<script>

import axios from "axios";
import Tabs from "@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/Tabs";
import AbstractPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel';
import FloatingPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel';
import CommonInputs from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/CommonInputs";
import SwitchInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/SwitchInput";
import AccordionInput from '@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/helpers/Input';
import VSelect from 'vue-select';

export default {

    extends: AbstractPanel,

    components: {
        SwitchInput,
        FloatingPanel,
        CommonInputs,
        Tabs,
        AccordionInput,
        VSelect,
    },

    data() {
        return {
            locations: [],
        };
    },

    mounted() {
        this.fetchLocations();
    },

    methods: {
        async fetchLocations() {
            try {
                const response = await axios.get(this.adminUrlPrefix + '/locations');
                this.locations = response.data;
            } catch (error) {
                console.error('Error fetching locations:', error);
            }
        },
    },

}

</script>

<style lang="scss">

.member\:\:canvas-blocks-modules-members-BlockPanel {

    .vs__dropdown-menu {
        position: static;
    }

}

</style>