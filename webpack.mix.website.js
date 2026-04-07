require('./galaxy/modules/Website/webpack.mix');

const GalaxyMix = require('./galaxy/node_scripts/galaxy-mix/GalaxyMix');

// const mix = require('laravel-mix');

// mix.browserSync('bm-duradis-galaxy.test');

GalaxyMix

    .nodeModuleDists([
        //'/../vendor/livewire/livewire/dist/livewire.js',
    ]);
