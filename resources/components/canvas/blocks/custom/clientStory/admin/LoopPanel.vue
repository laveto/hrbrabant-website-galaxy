<template>

    <FloatingPanel
        :title="title"
    >

        <div class="canvas::editor-website-editors-loop-LoopPanel">

            <SwitchInput
                label="Foto formaat"
                instruction=""
                :options="options"
                options-property="aspect_ratio"
                :items="[
                    { value: 'aspect-[7/5]', label: 'Rechthoek'},
                    { value: 'aspect-[384/200]', label: 'Langwerpig'},
                    { value: 'aspect-[1]', label: 'Vierkant'},
                    //{ value: 'aspect-[5/4]', label: 'Staand'},
                ]"
                defaultValue="aspect-[384/200]"
                :open="true"
            />

            <accordion-input :open="true">
                <template #label>

                    <div class="font-medium text-gray-600">Afrondingen</div>

                </template>
                <template #content>

                    <div class="flex items-center">

                        <select
                            class="w-full px-4 py-3 mt-1 transition ease-in-out border border-gray-300 border-solid rounded-md focus:border-indigo-600 focus:outline-none focus:shadow-outline-blue form-control form-input sm:leading-5 sm:text-sm"
                            v-model="options['rounded']"
                        >
                            <option v-for="option in roundedOptions" :value="option.class" :selected="option.class === options['rounded']">
                                {{ option.label }}
                            </option>
                        </select>

                    </div>

                </template>
            </accordion-input>

            <SwitchInput
                label="Aantal kolommen"
                instruction="Kies hier het aantal kolommen per rij."
                :items="[
                    { value: 2 },
                    { value: 3 },
                    { value: 4 },
                ]"
                :options="options"
                :defaultValue="3"
                options-property="columnsCount"
            />

            <SwitchInput
                label="Toon in container?"
                instruction=""
                :options="options"
                options-property="container"
                :items="[
                    { value: '1', label: 'Ja'},
                    { value: '0', label: 'Nee'},
                ]"
                defaultValue="1"
            />

            <div class="m-5">

                <button
                    class="btn btn-blue"
                    @click="addItem">
                    <i class="mr-1 fa fa-plus"></i> Item toevoegen
                </button>

            </div>

        </div>

    </FloatingPanel>

</template>

<script>

import LoopPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/loop/LoopPanel";
import FloatingPanel from "@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel";
import SwitchInput from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/SwitchInput";
import AccordionInput from '@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/helpers/Input';

export default {

    extends: LoopPanel,

    components: {
        FloatingPanel,
        SwitchInput,
        AccordionInput,
    },

    data() {
        return {
            roundedOptions: [
                {
                    class: '',
                    label: 'Geen afronding',
                },
                {
                    class: 'rounded-lg',
                    label: 'Kleine afronding',
                },
                {
                    class: 'rounded-2xl',
                    label: 'Middel afronding',
                },
                {
                    class: 'rounded-[2rem]',
                    label: 'Grote afronding',
                },
                {
                    class: 'rounded-full',
                    label: 'Volledige afronding',
                }
            ]
        };
    }

}

</script>

<style lang="scss" scoped>


</style>
