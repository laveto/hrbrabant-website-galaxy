import AutoloadViews from '@galaxy/modules/Core/resources/js/AutoloadViews';

// Include Concord module dependencies.
require('@galaxy/modules/Core/resources/js/sentry/withoutVue.js');
require('@galaxy/modules/Core/resources/js/View.js');
//require('@galaxy/modules/Core/resources/js/vue.js');
require('@galaxy/modules/Canvas/resources/js/bootstrap.website.js');
require('@galaxy/modules/Website/resources/js/partials/cookies.js');
require('@galaxy/modules/Website/resources/js/common/statistics.js');
require('@galaxy/modules/Website/resources/js/partials/menu.js');

// Load app specific JS.
// TODO Concord: How to overwrite? Does 2nd arg work?
AutoloadViews.load(
    'website',
    require.context('./website/', true, /.(js|vue)$/),
    require.context('./galaxy/website/', true, /.(js|vue)$/)
);
//AutoloadViews.load('components.website', require.context('./../components/website/', true, /.(js|vue)$/));
AutoloadViews.load('modules.website', require.context('./../../app/Modules/', true, /.(js|vue)$/));

// Start Livewire and Alpine.
addEventListener("DOMContentLoaded", (event) => {
    window.Livewire.start();
});
