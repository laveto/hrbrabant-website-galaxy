<template>

    <FloatingPanel title="Blog">

        <div class="canvas::blocks-modules-news-BlockPanel">

            <Tabs :tabs="[
                'Blog',
                'Algemeen',
            ]">

                <div slot="Blog">

                    <div class="m-5">

                        <div class="mb-1 text-gray-600 label2">Paginatie</div>

                        <input
                            type="text"
                            class="w-full px-3 py-2 mt-1 transition duration-150 ease-in-out border border-gray-300 border-solid rounded-md shadow-sm focus:border-blue-300 focus:outline-none focus:shadow-outline-blue form-control form-input sm:leading-5 sm:text-sm"
                            placeholder="10"
                            v-on:change="save()"
                            v-model="options.pagination"/>

                    </div>

                </div>

                <div slot="Algemeen">

                    <CommonInputs
                        :options="options"/>

                </div>

            </Tabs>

        </div>

    </FloatingPanel>

</template>

<script>

import Tabs from "@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/Tabs";
import AbstractPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/AbstractPanel';
import FloatingPanel from '@galaxy/modules/Canvas/resources/js/editor/website/editors/panels/FloatingPanel';
import CommonInputs from "@galaxy/modules/Canvas/resources/js/editor/website/editors/inputs/CommonInputs";

export default {

    extends: AbstractPanel,

    components: {
        FloatingPanel,
        CommonInputs,
        Tabs,
    },

}

</script>
