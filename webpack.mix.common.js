require('./galaxy/webpack.mix.common');

const GalaxyMix = require('./galaxy/node_scripts/galaxy-mix/GalaxyMix.js');

GalaxyMix

    .nodeModuleDists([
        'swiper/swiper-bundle.min.css',
        'swiper/swiper-bundle.min.js',
        'owl.carousel/dist/owl.carousel.min.js',
        'owl.carousel/dist/assets/owl.carousel.min.css',
    ]);
